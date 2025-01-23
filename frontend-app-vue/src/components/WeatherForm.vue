<template>
    <div class="min-h-screen bg-gray-100 flex flex-col items-center justify-center p-4">
        <div class="bg-white shadow-lg rounded-lg p-8 w-2/3">
            <h1 class="text-3xl font-bold text-green-500 mb-6 text-center">Weather App</h1>
            <form @submit.prevent="fetchWeather" class="space-y-4">
                <input v-model="city" placeholder="Enter city name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" />
                <p v-if="isCityInvalid" class="text-red-500 text-sm">
                    Please enter a valid city name (letters and spaces only).
                </p>
                <button type="submit"
                    class="w-full bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Get
                    Weather</button>
            </form>

            <div v-if="weatherData" class="mt-8">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-green-500 text-white">
                            <th class="px-4 py-2">City</th>
                            <th class="px-4 py-2">Temperature (°C)</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Last Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-gray-50 even:bg-white">
                            <td class="px-4 py-2 border border-gray-200 text-center">{{ weatherData.city_name }}</td>
                            <td class="px-4 py-2 border border-gray-200 text-center">{{ weatherData.temperature }}</td>
                            <td class="px-4 py-2 border border-gray-200 text-center">{{ weatherData.weather_description
                                }}</td>
                            <td class="px-4 py-2 border border-gray-200 text-center">
                                {{ new Date(weatherData.retrieved_at).toLocaleString() }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p v-if="error" class="mt-4 text-red-500 text-center">{{ error }}</p>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const city = ref('');
const weatherData = ref(null);
const error = ref('');

// Validation logic
const isCityInvalid = computed(() => {
    const cityValue = city.value.trim();
    if (!cityValue) return false; // Allow empty input to show required attribute message
    return !/^[A-Za-z\s]+$/.test(cityValue); // Check if city contains only letters and spaces
});

const fetchWeather = async () => {
    if (isCityInvalid.value) {
        error.value = 'Please enter a valid city name.';
        return;
    }

    try {
        const response = await fetch(`http://localhost:8000/api/weather?city=${city.value}`);
        if (!response.ok) throw new Error('Failed to fetch weather data');
        weatherData.value = await response.json();
        error.value = '';
    } catch (err) {
        error.value = err.message;
        weatherData.value = null;
    }
};
</script>