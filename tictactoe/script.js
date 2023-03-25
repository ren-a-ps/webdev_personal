const squares = document.querySelectorAll('.square');
const restartButton = document.querySelector('#restart');
let currentPlayer = 'X';

function handleSquareClick(event) {
  const square = event.target;
  if (square.textContent !== '') {
    return;
  }
  square.textContent = currentPlayer;
  if (checkWin()) {
    alert(`${currentPlayer} wins!`);
    restartGame();
  } else if (checkTie()) {
    alert("It's a tie!");
    restartGame();
  } else {
    currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
  }
}

function checkWin() {
  const winningCombos = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
  ];
  return winningCombos.some(combo => {
    const [a, b, c] = combo;
    return squares[a].textContent !== '' &&
           squares[a].textContent === squares[b].textContent &&
           squares[b].textContent === squares[c].textContent;
  });
}

function checkTie() {
  return Array.from(squares).every(square => {
    return square.textContent !== '';
  });
}

function restartGame() {
  Array.from(squares).forEach(square => {
    square.textContent = '';
  });
  currentPlayer = 'X';
}

function init() {
  Array.from(squares).forEach(square => {
    square.addEventListener('click', handleSquareClick);
  });
  restartButton.addEventListener('click', restartGame);
}

init();