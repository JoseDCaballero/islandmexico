<template>
    <Head :title="tour.tour_name" />
    <SimpleLayout>
        <div class="tour-detail-container">
            <div class="image-container">
                <div class="parallax-image" :style="{ backgroundImage: `url(${tour.imagen})` }"></div>
                <div class="overlay-content">
                    <h1 class="tour-title" style="color: #fff">{{ tour.tour_name }}</h1>
                    <!-- Sección del video en el overlay -->
                    <div v-if="tour.video" class="video-container">
                        <video :src="tour.video" class="tour-video" autoplay muted loop></video>
                    </div>
                    <div class="gallery">
                        <div v-if="images.length">
                            <div v-for="(image, index) in images" :key="index" class="image-item">
                                <img :src="image" alt="Tour Image" />
                            </div>
                        </div>
                        <div v-else>
                            No images available.
                        </div>
                    </div>
                    <div class="text-and-form">
                        <!-- Contenedor de textos relevantes con efecto cristal -->
                        <div class="text-container">
                            <div class="crystal-background">
                                <div class="text-content">
                                    <div v-html="formattedText"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Formulario alineado a la derecha -->
                        <div class="form-new">
                            <div class="form-container">
                                <form class="tour-form" @submit.prevent="handleSubmit">
                                    <div class="form-group">
                                        <label for="name">Full name</label>
                                        <input type="text" id="name" v-model="form.name" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" v-model="form.email" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone-number">Phone number</label>
                                        <div class="phone-input-group">
                                            <select v-model="form.countryCode" required>
                                                <option value="+1">+1 (USA)</option>
                                                <option value="+44">+44 (UK)</option>
                                                <option value="+52">+52 (Mexico)</option>
                                                <option value="+61">+61 (Australia)</option>
                                                <option value="+81">+81 (Japan)</option>
                                            </select>
                                            <input type="tel" id="phone-number" v-model="form.phoneNumber" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Booking date</label>
                                        <input type="date" id="date" v-model="form.date" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="people">Passengers</label>
                                        <input type="number" id="people" v-model="form.passengers"
                                            @input="updateAmountTour" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount tour</label>
                                        <input type="number" id="amount" v-model="form.amountTour" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Comments</label>
                                        <textarea id="message" v-model="form.message"></textarea>
                                    </div>
                                    <button type="submit">Book now</button>
                                </form>
                            </div>
                            <div class="meeting-place-container">
                                <h1 class="text-content" style="font-size: 25px;">Meeting place:</h1>
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7437.072316294123!2d-86.7428208!3d21.2502343!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f4c300370f9450b%3A0xe713a3cbe997ca76!2sDestino%20Island%20Adventure!5e0!3m2!1ses-419!2smx!4v1725170361701!5m2!1ses-419!2smx"
                                    width="600" height="500" class="tour-map" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </SimpleLayout>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import SimpleLayout from '@/Layouts/SimpleLayout.vue';
import axios from 'axios';

const images = ref([]);

const props = defineProps({
    tour: Object, // Recibe el objeto del tour desde el backend
});

const fetchImages = async () => {
    try {
        console.log("Este es el id que se está pasando: "+props.tour.id)
        const tourId = props.tour.id; // Cambia esto al ID de tu tour        
        const response = await axios.get(`/tour-images/${tourId}`);
        images.value = response.data;
    } catch (error) {
        console.error('Error fetching images:', error);
    }
};

const form = reactive({
    name: '',
    email: '',
    countryCode: '+1', // Código de país por defecto
    phoneNumber: '',
    date: '', // Campo para la fecha seleccionada
    passengers: 1, // Campo para el número de pasajeros
    amountTour: 1, // Cantidad de tours que se van a comprar, comienza en 1
    message: '', // Campo para comentarios
});

function formatText(text) {
    if (!text) return '';

    return text
        .replace(/##(.*?)\n/g, '<strong>$1</strong><br>')  // Convierte los títulos con "##" en negritas y añade un salto de línea
        .replace(/\n\n/g, '</p><p>')                       // Convierte dobles saltos de línea en nuevos párrafos
        .replace(/\n/g, '<br>');                           // Convierte un solo salto de línea en <br>
}

const formattedText = ref(formatText(props.tour.descripcion));

// Función que se encarga de actualizar la cantidad de tours basándose en el número de pasajeros
function updateAmountTour() {
    const maxPassengersPerTour = 13;
    form.amountTour = Math.ceil(form.passengers / maxPassengersPerTour);
}

function handleSubmit() {
    alert(`Nombre: ${form.name}\nEmail: ${form.email}\nTeléfono: ${form.countryCode} ${form.phoneNumber}\nFecha: ${form.date}\nPasajeros: ${form.passengers}\nPaquetes de tours: ${form.amountTour}\nMensaje: ${form.message}`);
    // Aquí puedes enviar los datos del formulario al backend si es necesario ##si es necesario llevarlo al backend
}

onMounted(() => {
    const parallax = document.querySelector('.parallax-image');

    window.addEventListener('scroll', function () {
        let offset = window.pageYOffset;
        parallax.style.transform = `translateY(${offset * 0.5}px)`;
    });

    fetchImages();
});
</script>

<style scoped>
/* Diseño general */
body {
    font-family: 'Poppins', sans-serif;
    color: #2c3e50;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.tour-detail-container {
    width: 100%;
    min-height: 100vh;
    position: relative;
    overflow: auto;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)) no-repeat center center fixed;
    background-size: cover;
    padding-top: 20px;
}

.image-container {
    position: relative;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 0 20px;
}

.parallax-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transform: translateY(0);
    transition: transform 0.1s ease-out;
    z-index: 1;
    opacity: 0.8;
}

.overlay-content {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    padding: 30px;
    background-color: rgba(0, 0, 0, 0.6);
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.text-and-form {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-start;
    width: 100%;
    gap: 20px;
}

.text-container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 20px;
}

.crystal-background {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(15px);
    border-radius: 15px;
    padding: 25px;
    max-width: 90%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.text-content {
    color: #ecf0f1;
    text-align: left;
    font-size: 1.2em;
    line-height: 1.6;
}

.tour-title {
    font-size: 3em;
    font-weight: bold;
    margin: 0 0 20px 0;
    text-align: center;
    color: #ecf0f1;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
}

.form-container {
    background-color: rgba(255, 255, 255, 0.9);
    width: 100%;
    max-width: 450px;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.form-new {
    max-width: 100%;
    margin-left: auto;
    padding: 20px;
    border-radius: 15px;
}

.tour-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
}

.form-group label {
    font-weight: bold;
    margin-bottom: 5px;
    color: #2c3e50;
}

.form-group input,
.form-group textarea,
.form-group select {
    padding: 12px;
    border: 1px solid #bdc3c7;
    border-radius: 8px;
    font-size: 1em;
    color: #34495e;
}

button[type="submit"] {
    padding: 12px 20px;
    background-color: #3c6de7;
    color: white;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1.2em;
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #335bc1;
}

/* Estilos para el contenedor de medios */
.media-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 30px;
    width: 100%;
}

.video-container {
    width: 100%;
    max-width: 600px;
    margin: 20px 0;
    z-index: 3;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.tour-video {
    width: 100%;
    height: auto;
    display: block;
}

/* Estilos para el mapa */
.tour-map {
    width: 100%;
    max-width: 800px;
    height: auto;
    border-radius: 15px;
    z-index: 3;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    border: none;
}

.meeting-place-container {
    margin-top: 30px;
}

.gallery {
    display: flex;
    justify-content: center;
    /* Centra el contenido horizontalmente */
    overflow-x: auto;
    /* Permite desplazamiento horizontal si las imágenes no caben en la vista */
    padding: 20px;
    gap: 20px;
    /* Espacio entre imágenes */
}

.image-item {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s, box-shadow 0.3s;
    display: inline-block;
    /* Permite que los elementos se alineen horizontalmente */
}

.image-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-item:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
}
</style>