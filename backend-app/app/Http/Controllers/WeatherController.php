<?php

namespace App\Http\Controllers;

use App\Models\WeatherData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    //
    public function getWeather(Request $request)
    {
        // Validate city name
        $request->validate([
            'city' => 'required|string|max:255',
        ]);

        $city = $request->input('city');
        $apiKey = env('OPENWEATHERMAP_API_KEY');

        // Check if data is cached
        $cachedData = WeatherData::where('city_name', $city)
            ->where('retrieved_at', '>=', Carbon::now()->subHour())
            ->first();

        if ($cachedData) {
            return response()->json($cachedData);
        }

        // Fetch data from OpenWeatherMap API
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric");

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch weather data'], 500);
        }

        $weatherData = $response->json();

        // Save data to the database
        $data = WeatherData::create([
            'city_name' => $city,
            'temperature' => $weatherData['main']['temp'],
            'weather_description' => $weatherData['weather'][0]['description'],
            'retrieved_at' => Carbon::now(),
        ]);

        return response()->json($data);
    }
}
