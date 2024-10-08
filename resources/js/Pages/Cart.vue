<script setup>
import { ref, onMounted, computed } from 'vue';
import SimpleLayout from '@/Layouts/SimpleLayout.vue';
import { Head } from '@inertiajs/vue3';
import Pagos from '@/Components/Pagos.vue';

const tours = ref([]);

const deleteData = () => {
    const confirmacion = confirm("Are you sure you want to drop your cart?");
    if (confirmacion === true) {
        localStorage.removeItem("tours");
        window.location.reload();
    }
};

onMounted(() => {
    const storedTours = JSON.parse(localStorage.getItem('tours')) || [];
    tours.value = storedTours;
});

const priceTotal = computed(() => {
    return tours.value.reduce((total, tour) => total + tour.total, 0) / 100;
});
</script>

<template>
    <SimpleLayout />
    <Head title="Cart" />
    <h1>Your Cart</h1>
    <div v-if="tours.length > 0">
        <div v-for="(tour, index) in tours" :key="index" class="tour-card">
            <h3>Tour Name: <span>{{ tour.tourName }}</span></h3>
            <h3>Reference Name: <span>{{ tour.name }}</span></h3>
            <h3>Tour Date: <span>{{ tour.date }}</span></h3>
            <h3>Passengers Total: <span>{{ tour.people }}</span></h3>
            <h3>Price to Pay: <span>${{ tour.total / 100 }} USD</span></h3>
        </div>
        <p>Total price to pay: ${{ priceTotal }} USD</p>
        <button @click="deleteData" class="clear-cart-button">Clear Cart</button>
        <Pagos :total="priceTotal * 100" />
    </div>
    <div v-else>
        <p>Your cart is empty.</p>
        <a href="/tours"><p>Click here and take a look of our tours</p></a>
    </div>    
</template>

<style scoped>
h1 {
  text-align: center;
  margin-bottom: 20px;
}

.tour-card {
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  margin-bottom: 20px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.tour-card h3 {
  margin: 10px 0;
}

.tour-card h3 span {
  font-weight: normal;
  color: #555;
}

.clear-cart-button {
  display: block;
  margin: 20px auto;
  padding: 10px 20px;
  background-color: #ff4d4d;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.clear-cart-button:hover {
  background-color: #ff1a1a;
}
</style>