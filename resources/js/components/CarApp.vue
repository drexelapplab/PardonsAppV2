<template>
    <div id="app">
        <div class="heading">
            <h1>cars</h1>
        </div>
        <car-component
                v-for="car in cars"
                v-bind="car"
                :key="car.id"
                @update="update"
                @delete="del"
        ></car-component>
        <div>
            <button @click="create()">Add</button>
        </div>
    </div>
</template>

<script>
  function Car({ id, color, model}) {
    this.id = id;
    this.color = color;
    this.model = model;
  }
  import carComponent from './CarComponent.vue';
  export default {
    data() {
      return {
        cars: [],
        working: false
      }
    },
    methods: {
      create() {
        this.mute = true;
        window.axios.get('/api/cars/create').then(({ data }) => {
          this.cars.push(new Car(data));
          this.mute = false;
        });
      },
      read() {
        this.mute = true;
        window.axios.get('/api/cars').then(({ data }) => {
          data.forEach(car => {
            this.cars.push(new Car(car));
          });
          this.mute = false;
        });
      },
      update(id, color) {
        this.mute = true;
        window.axios.put(`/api/cars/${id}`, { color }).then(() => {
          this.cars.find(car => car.id === id).color = color;
          this.mute = false;
        });
      },
      del(id) {
        this.mute = true;
        window.axios.delete(`/api/cars/${id}`).then(() => {
          let index = this.cars.findIndex(car => car.id === id);
          this.cars.splice(index, 1);
          this.mute = false;
        });
      }
    },
    watch: {
      mute(val) {
        document.getElementById('mute').className = val ? "on" : "";
      }
    },
    components: {
      carComponent
    },
    created() {
      this.read();
    }
  }
</script>
<style>
    #app {
        margin-left: 1em;
    }
    .heading h1 {
        margin-bottom: 0;
    }
</style>