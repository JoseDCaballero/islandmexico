<template>
    <div class="tours-container">
        <div v-if="loading" class="loading">
            <p>Loading...</p>
        </div>
        <div v-else>
            <div class="carousel-container">
                <h1 class="tours-title">Perfect to swim</h1>
                <div class="carousel">
                    <div v-for="tour in filteredTours('snorkel')" :key="tour.id" class="carousel-item">
                        <a :href="tour.route">
                            <div class="tour-label">{{ getRandomLabel() }}</div>
                            <div :style="{ backgroundImage: `url(${tour.imagen})` }" class="tour-card">
                                <div class="tour-content">
                                    <a :href="tour.route">
                                    <h2 class="tour-title">{{ tour.tour_name }}</h2>
                                    </a>
                                    <a :href="tour.route">
                                    <p class="tour-price">See more</p>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="carousel-container">
                <h1 class="tours-title">Live unique experiences</h1>
                <div class="carousel">
                    <div v-for="tour in filteredTours('experiences')" :key="tour.id" class="carousel-item">
                        <a :href="`/tours/${tour.route.split('/')[1]}`">
                            <div class="tour-label">{{ getRandomLabel() }}</div>
                            <div :style="{ backgroundImage: `url(${tour.imagen})` }" class="tour-card">
                                <div class="tour-content">
                                    <a :href="`/tours/${tour.route.split('/')[1]}`">
                                    <h2 class="tour-title">{{ tour.tour_name }}</h2>
                                    </a>
                                    <a :href="`/tours/${tour.route.split('/')[1]}`">
                                    <p class="tour-price">See more</p>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="carousel-container">
                <h1 class="tours-title">Swimming with whale shark</h1>
                <div class="carousel">
                    <div v-for="tour in filteredTours('whaleshark')" :key="tour.id" class="carousel-item">
                        <a :href="`/tours/${tour.route.split('/')[1]}`">
                            <div class="tour-label">{{ getRandomLabel() }}</div>
                            <div :style="{ backgroundImage: `url(${tour.imagen})` }" class="tour-card">
                                <div class="tour-content">
                                    <a :href="`/tours/${tour.route.split('/')[1]}`">
                                    <h2 class="tour-title">{{ tour.tour_name }}</h2>
                                    </a>
                                    <a :href="`/tours/${tour.route.split('/')[1]}`">
                                    <p class="tour-price">See more</p>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="carousel-container">
                <h1 class="tours-title">Fishing experiences</h1>
                <div class="carousel">
                    <div v-for="tour in filteredTours('fishing')" :key="tour.id" class="carousel-item">
                        <!-- <a :href="tour.route"><div :style="{ backgroundImage: `url(${tour.imagen})` }" class="tour-card">
                            <div class="tour-content">
                                <Link :href="tour.route">
                                    <h2 class="tour-title">{{ tour.tour_name }}</h2>
                                </Link>
                                <Link :href="tour.route">
                                    <p class="tour-price">>See more</p>
                                </Link>
                            </div>
                        </div></a> -->
                        <a :href="`/tours/${tour.route.split('/')[1]}`">
                            <div class="tour-label">{{ getRandomLabel() }}</div>
                            <div :style="{ backgroundImage: `url(${tour.imagen})` }" class="tour-card">
                                <div class="tour-content">
                                    <a :href="`/tours/${tour.route.split('/')[1]}`">
                                    <h2 class="tour-title">{{ tour.tour_name }}</h2>
                                    </a>
                                    <a :href="`/tours/${tour.route.split('/')[1]}`">
                                    <p class="tour-price">See more</p>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="error" class="error">
            <p>{{ error }}</p>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const tours = ref([]);
const loading = ref(true);
const error = ref('');

onMounted(async () => {
    try {
        const response = await axios.get('/api/tours');
        tours.value = response.data;
    } catch (err) {
        error.value = 'Failed to load tours. Please try again later.';
    } finally {
        loading.value = false;
    }
});

function filteredTours(kind) {
    return tours.value.filter(tour => tour.kind === kind);
}

function getRandomLabel() {
    const phrases = [
        'Special offer!',
        'Last chance!',
        'Available today!',
        'Book now',
        'Unique experience',
        'Unforgettable experience!',
        'Don´t waste more time!',
        'Top sales'
    ];
    const randomIndex = Math.floor(Math.random() * phrases.length);
    return phrases[randomIndex];
}

</script>

<style scoped>
.tours-container {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.loading {
    text-align: center;
    font-size: 18px;
}

.tours-title {
    margin-bottom: 10px;
    text-align: center;
    font-size: 28px;
    font-weight: bold;
}

.carousel-container {
    margin-bottom: 30px;
}

.carousel {
    display: flex;
    overflow-x: scroll;
    gap: 20px;
    padding-bottom: 10px;
    scroll-snap-type: x mandatory;
}

.carousel-item {
    flex: 0 0 auto;
    scroll-snap-align: start;
    width: 300px;
}

.tour-card {
    background-size: cover;
    background-position: center;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 350px;
    position: relative;
    /*overflow: hidden;*/
    overflow: visible;
}

.tour-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.tour-content {
    z-index: 2;
    position: relative;
}

.tour-title {
    font-size: 22px;
    margin-bottom: 8px;
}

.tour-title:hover {
    color: gray;
}

.tour-price {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 8px;
}

.tour-price:hover {
    color: gray;
}

.error {
    text-align: center;
    color: red;
    font-size: 18px;
    margin-top: 20px;
}

.carousel-item {
    position: relative; /* Asegura que el globo se posicione correctamente sobre el contenedor */
}

.tour-label {
    position: absolute;
    top: 15px; /* Ahora lo bajamos un poco dentro del card */
    left: 50%;
    transform: translateX(-50%);
    background-color: #ff5a5f;
    color: white;
    font-size: 14px;
    padding: 8px 12px; /* Tamaño ajustado */
    border-radius: 50px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    z-index: 3;
    font-weight: bold;
    animation: bounce 1.5s infinite;
    width: auto; /* Se adapta al contenido */
    white-space: nowrap; /* Evita que el texto se corte o envuelva */
}

/* Animación de rebote */
@keyframes bounce {
    0%, 100% {
        transform: translate(-50%, 0);
    }
    50% {
        transform: translate(-50%, -10px);
    }
}
</style>