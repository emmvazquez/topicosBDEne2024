<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubicaciones</title>
  <!-- Cargar Vue.js desde CDN -->
  <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</head>
<body>
  <div id="app">
    <h1>Ubicaciones</h1>
    <form action="<?=base_url('clima/insertClima'); ?>" method="POST">
        <input type="text" name="latitud">
        <input type="text" name="CP">
        <input type="submit">
        
    <select name="ubicacion">
      <option v-for="(ubicacion, index) in ubicaciones" :key="index">{{ ubicacion.ubicacion }}</option>
    </select>
    </form>
  </div>
</body>




<script>
    new Vue({
      el: '#app',
      data: {
        ubicaciones: []
      },
      mounted() {
        this.fetchData();
      },
      methods: {
        async fetchData() {
          try {
            const response = await fetch('http://localhost:8080/clima/getUbicaciones');
            const data = await response.json();
            this.ubicaciones = data.datos;
          } catch (error) {
            console.error('Error al recuperar los datos:');
          }
        }
      }
    });
  </script>