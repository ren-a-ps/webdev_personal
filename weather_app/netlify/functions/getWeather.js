require("dotenv").config();

const axios = require("axios");

exports.handler = async (event, context) => {
    try {
      const { city } = event.queryStringParameters;
      let url = `https://api.openweathermap.org/data/2.5/weather?units=metric&q=${city}&appid=${process.env.OPENWEATHERMAP_API_KEY}`
      let response = await axios.get(url);

      return {
        statusCode: 200,
        body: JSON.stringify(response.data),
      };
    } catch (error) {
      return {
        statusCode: 500,
        body: JSON.stringify({ error }),
      };
    }
  };