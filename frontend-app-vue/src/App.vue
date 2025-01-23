<template>
  <WeatherForm />
</template>

<script>
import WeatherForm from './components/WeatherForm.vue';

export default {
  name: 'App',
  components: {
    WeatherForm
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
