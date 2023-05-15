//Selectors
const api_key = '';
const search_btn = document.querySelector(".search_btn");
const input_city = document.querySelector(".input_city");
const temp = document.querySelector(".temp");
const city = document.querySelector(".city");
const humidity = document.querySelector(".humidity");
const wind = document.querySelector(".wind");
const weather_icon = document.querySelector(".weather_icon");
const description = document.querySelector(".description");

//Functions
const displayWeather = (data, event) => {
    const weather = data.weather[0].main;
    const weather_desc =data.weather[0].description;

    if (weather === 'Fog' || weather === 'Haze' || weather === 'Mist') {
        weather_icon.src = `images\fog.png`;
    } else {
        weather_icon.src = `images\${weather.toLowerCase()}.png`;
    }

    temp.innerText = `${Math.round(data.main.temp)}°c`;
    city.innerText = `${data.name}, ${data.sys.country}`;
    humidity.innerText = `${data.main.humidity}%`;
    wind.innerText = `${data.wind.speed} km/h`;
    description.innerText = `${weather_desc.charAt(0).toUpperCase()}${weather_desc.slice(1)}`;
};

const displayError = (response) => {
    weather_icon.src = `images\clear.png`;
    temp.innerText = "...";
    city.innerText = response.statusText;
    humidity.innerText = "...";
    wind.innerText = "...";
    description.innerText = "...";
};

const fetchWeather = async (city) => {
    const url = `https://api.openweathermap.org/data/2.5/weather?units=metric&q=${city}&appid=${api_key}`
    const response = await fetch(url);
    const data = await response.json();
    try {
        if (response.ok) {
            displayWeather(data);
        } else {
            console.error(`Fetch Try Error: ${response.statusText}`);
            displayError(response);
        }
    } catch (error) {
        console.error(`Fetch Catch Error: ${error}`);
    }
};

//Event Listeners
document.addEventListener('DOMContentLoaded', () => fetchWeather('manila'));

search_btn.addEventListener("click", () => {
    if (input_city.value != "") {
        fetchWeather(input_city.value);
        input_city.value = '';
    }
});



input_city.addEventListener("keypress", (e) => {
    if (e.key === 'Enter') {
        fetchWeather(input_city.value);
        input_city.value = ''; 
    }
});