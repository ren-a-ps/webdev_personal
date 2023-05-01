//Selectors
const todoInput = document.querySelector('.todo-input');
const todoButton = document.querySelector('.todo-button');
const todoList = document.querySelector('.todo-list');
const filterOption = document.querySelector('.filter-todo');

//Functions
const checkTodos = () => {
    //Checks if there are todo items saved in local storage
    if (localStorage.getItem('todos') === null) {
        return [];
    } else {
        //localStorage is a built-in object in web browsers that allows web developers to store key-value pairs in the user's web browser. 
        return JSON.parse(localStorage.getItem('todos'));
    }
};

const saveLocalTodos = (todo,isDone = false) => {
    let todos = checkTodos(); 
    todos.push({todo,isDone});
    localStorage.setItem('todos', JSON.stringify(todos));
};

const getLocalTodos = () => {
    let todos = checkTodos(); 
    todos.forEach((task) => {
        addTodo(task.todo,task.isDone);
    });
};

const removeLocalTodos = (todo) => {
    let todos = checkTodos(); 
    const todoIndex = todo.children[0].innerText;
    //todos.map() returns a new array with only the values of todo property
    //The .indexOf() gets the index of the value we specified
    //The splice() method adds and/or removes array elements. This method overwrites the original array.
    todos.splice(todos.map(task => task.todo).indexOf(todoIndex), 1);
    localStorage.setItem('todos', JSON.stringify(todos));
};

const editLocalTodos = (todo, todoOldValue, isDone = false) => {
    let todos = checkTodos();
    const todoNewValue = todo.children[0].innerText;
    todos.splice(todos.map(task => task.todo).indexOf(todoOldValue), 1, {todo: todoNewValue, isDone: isDone});
    localStorage.setItem('todos', JSON.stringify(todos));
};

const addTodo = (input,isDone = false) => {
    //Add div
    const todoDiv = document.createElement('div');
    todoDiv.classList.add('todo');
    if (isDone) {
        //This adds the class "completed" if the task has been completed before
        //This is only used by getLocalTodos function
        todoDiv.classList.toggle('completed'); 
    } 
    //Add li
    const newTodo = document.createElement('li');
    newTodo.innerText = input;
    newTodo.classList.add('todo-item')
    todoDiv.appendChild(newTodo);
    //Edit button
    const editButton = document.createElement('button');
    editButton.innerHTML = '<i class="fa-solid fa-pen"></i>'
    editButton.classList.add('edit-btn');
    todoDiv.appendChild(editButton);
    //Check-mark Button
    const completedButton = document.createElement('button');
    completedButton.innerHTML = '<i class="fa-solid fa-check"></i>'
    completedButton.classList.add('complete-btn');
    todoDiv.appendChild(completedButton);
    //Minus Button
    const minusButton = document.createElement('button');
    minusButton.innerHTML = '<i class="fa-solid fa-minus"></i>'
    minusButton.classList.add('minus-btn');
    todoDiv.appendChild(minusButton);
    //Append to list   
    todoList.appendChild(todoDiv);
};

const deleteCheckTodo = (e) => {
    const item = e.target;
    //Delete
    if(item.classList[0] === 'minus-btn') {
        const todo = item.parentElement;
        //Animation
        todo.classList.add('fall');
        removeLocalTodos(todo);
        todo.addEventListener('transitionend', () => {
            todo.remove();
        });
    }
    //Check-mark
    if(item.classList[0] === 'complete-btn') {
        const todo = item.parentElement;
        const todoValue= todo.children[0].innerText;
        editLocalTodos(todo,todoValue,true);
        todo.classList.toggle('completed');
        //set the isDone property to true
        //check getLocalTodos function
    }

    //Edit
    if(item.classList[0] === 'edit-btn') {
        const todo = item.parentElement;
        const todoValue= todo.children[0].innerText;
        todo.contentEditable = true;
        todo.addEventListener('blur', () => {
            todo.contentEditable = false;
            editLocalTodos(todo,todoValue);
        });
    }
};

const filterTodo = (event) => {
    const todos = todoList.childNodes;
    todos.forEach((todo)=> {
        switch(event.target.value){
            case 'all': 
                todo.style.display = 'flex';
                break;
            case 'done':
                if(todo.classList.contains('completed')) {
                    todo.style.display = 'flex';
                } else {
                    todo.style.display = 'none';
                }
                break;
            case 'ongoing':
                if(!todo.classList.contains('completed')) {
                    todo.style.display = 'flex';
                } else {
                    todo.style.display = 'none';
                }
                break;
        }
    });
};

//Event Listeners
document.addEventListener('DOMContentLoaded', getLocalTodos);
todoButton.addEventListener('click', (event) => {
    //Prevents form from submitting
    event.preventDefault();
    //Check if todoInput is not empty
    if(todoInput.value != ''){
        //Save TODO to local storage
        saveLocalTodos(todoInput.value)
        addTodo(todoInput.value);
    }
    //Clear todoInput value
    todoInput.value = '';
});
todoList.addEventListener('click', deleteCheckTodo);
filterOption.addEventListener('click', filterTodo);

