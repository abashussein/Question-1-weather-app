import './bootstrap';

import { createApp } from 'vue'
import WeatherForm from '../views/components/WeatherForm.vue';

const app = createApp(WeatherForm)

app.mount('#app')