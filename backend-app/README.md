# Weather App

This is a simple weather app built using Laravel and Vue.js. It demonstrates how to fetch weather data from an API and display it in a user-friendly way.

## Prerequisites

Before you can run this app, you need to have the following installed:

- PHP 8.1+
- Composer
- Node.js 16+

## Installation

1. Clone the repository

2. Navigate to the project directory:

```bash
cd weather-app
```

3. Install the project dependencies:

```bash
composer install
```

4. Copy the `.env.example` file to `.env` and update the values as needed:

```bash
cp .env.example .env
```

5. Install the Node.js dependencies:

```bash
npm install
```

6. Start the development server:

```bash
npm run dev
```

7. Start the artisan server:

```bash
php artisan serve
```

8. The backend server should now be running at `http://localhost:8000`.

That's it! You should now be able to start the frontend to see the weather app running.

## Usage

To fetch weather data, you need to provide an API key. You can get one for free from [OpenWeatherMap](https://openweathermap.org/api).

Once you have an API key, update the `.env` file with your API key:

```bash
OPENWEATHERMAP_API_KEY="your_api_key_here"
```

You can now fetch weather data by entering a city name in the form and clicking the "Get Weather" button.

## Handling of API keys

The API key is stored in the `.env` file which is present in the `.gitignore` file. This means that the key is not stored in the repository and is only available in the local environment.

## Input validation

The form in the app validates the input to ensure that it only contains letters and spaces. If the input is invalid, an error message is displayed.

## Storage of weather data

The weather data is stored in the database. This means that the data is persistent and can be accessed even after the server is restarted.

The structure of the database table is as follows:

| Column Name | Data Type | Description |
| ----------- | --------- | ----------- |
| city_name   | string    | The name of the city |
| temperature | decimal(5,2)   | The temperature in Celsius |
| weather_description | string | A description of the weather condition |
| retrieved_at | timestamp | The timestamp when the data was retrieved |

## Front end

The front end is built using Vue.js and Tailwind CSS.

## Back end

The back end is built using Laravel and the `routes/api.php` file contains the routes for the API. The `app/Http/Controllers/WeatherController.php` file contains the controller for the API.

Under `routes/api.php`, the `getWeather` route is defined to handle the API request. The `WeatherController` class contains the logic for the API.

The `app/Models/WeatherData.php` file contains the model for the database table. It contains a fillable property to specify which columns can be mass updated.