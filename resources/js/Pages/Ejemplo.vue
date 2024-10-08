<template>
  <SimpleLayout>
    <Head :title="tour.tour_name" />
    <div class="carousel-container" v-if="images.length">
      <div class="carousel">
        <div class="carousel-images">
          <img v-for="(image, index) in images" :key="index" :src="image" alt="Tour Image" class="carousel-image"
            :class="{ 'active': currentIndex === index }" />
        </div>
        <button @click="prevImage" class="carousel-button carousel-prev">&#10094;</button>
        <button @click="nextImage" class="carousel-button carousel-next">&#10095;</button>
      </div>
      <div class="carousel-text">
        <h2>{{ tour.tour_name }}</h2>
        <p>The <span style="text-decoration: line-through;">unforgettable</span> experience in Isla Mujeres</p>
      </div>
    </div>

    <div v-else class="no-images">
      No images available.
    </div>

    <section>
      <div class="main-content flex-container">
        <div class="info-container flex-item text-section">
          <div class="text-container w-full">
            <h1 class="nombre-tour">{{ tour.tour_name }}</h1>
            <div v-html="formattedText" style="text-align: left;" />
          </div>
        </div>

        <div class="grid-container flex-item form-section">
          <!-- Formulario de Reserva -->
          <div class="form-container max-w-md mx-auto p-4 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Reserve your spot for {{ tour.tour_name }} now!
            </h2>
            <form @submit.prevent="handleSubmit" class="space-y-6">
              <div class="flex flex-col space-y-2">
                <label for="name" class="text-lg font-semibold text-gray-700 flex items-center">
                  <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 14v7m0 0h8m-8 0H4m8-7L3 6m9 8l9-5m0 0L21 6"></path>
                  </svg>
                  Full name
                </label>
                <input type="text" id="name" v-model="form.name" placeholder="Type your full name"
                  class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required />
              </div>
              <div class="flex flex-col space-y-2">
                <label for="email" class="text-lg font-semibold text-gray-700 flex items-center">
                  <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l9 6 9-6M3 8v13h18V8">
                    </path>
                  </svg>
                  Email
                </label>
                <input type="email" id="email" v-model="form.email" placeholder="Type your email"
                  class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required />
              </div>
              <div class="flex flex-col space-y-2">
                <!-- Selector de Ladas Internacionales -->
                <div class="flex items-center space-x-2">
                  <label for="country-code" class="text-lg font-semibold text-gray-700 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6.62 10.79a10.05 10.05 0 006.76 6.76l1.31-1.31a2 2 0 012.17-.45l2.82 1.13a2 2 0 011.23 1.23l1.13 2.82a2 2 0 01-.45 2.17l-1.31 1.31a10.05 10.05 0 01-6.76-6.76L9.21 6.62a2 2 0 00-2.17-.45L4.22 7.3a2 2 0 00-1.23 1.23l-1.13 2.82a2 2 0 00.45 2.17l1.31 1.31z">
                      </path>
                    </svg>
                    Country code
                  </label>
                  <select id="country-code" v-model="form.countryCode"
                    class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="+52">+52 (México)</option>
                    <option value="+1">+1 (Estados Unidos)</option>
                    <option value="+44">+44 (Reino Unido)</option>
                    <option value="+33">+33 (Francia)</option>
                    <option value="+34">+34 (España)</option>
                  </select>
                </div>
                <!-- Campo de Número de Teléfono -->
                <label for="phone" class="text-lg font-semibold text-gray-700 flex items-center">
                  <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M6.62 10.79a10.05 10.05 0 006.76 6.76l1.31-1.31a2 2 0 012.17-.45l2.82 1.13a2 2 0 011.23 1.23l1.13 2.82a2 2 0 01-.45 2.17l-1.31 1.31a10.05 10.05 0 01-6.76-6.76L9.21 6.62a2 2 0 00-2.17-.45L4.22 7.3a2 2 0 00-1.23 1.23l-1.13 2.82a2 2 0 00.45 2.17l1.31 1.31z">
                    </path>
                  </svg>
                  Phone number
                </label>
                <input type="tel" id="phone" v-model="form.phone" maxlength="10" placeholder="Type your phone number"
                  class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required />
              </div>
              <div class="flex flex-col space-y-2">
                <label for="date" class="text-lg font-semibold text-gray-700 flex items-center">
                  <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 2v4M8 2v4m-5 4h18M4 6v12a2 2 0 002 2h12a2 2 0 002-2V6H4z"></path>
                  </svg>
                  Book date
                </label>
                <input type="date" id="date" v-model="form.date"
                  class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" :min="minDate" required />
              </div>
              <div class="flex flex-col space-y-2">
                <label for="people" class="text-lg font-semibold text-gray-700 flex items-center">
                  <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11.049 2.927A6.978 6.978 0 0112 2a6.978 6.978 0 01.951.927M21 10c0 5.25-4.25 10.5-9 10.5S3 15.25 3 10a9.004 9.004 0 014.68-8.865A6.978 6.978 0 0112 2a6.978 6.978 0 014.32 1.135A9.004 9.004 0 0121 10z">
                    </path>
                  </svg>
                  Passengers
                </label>
                <input type="number" id="people" v-model="form.people" min="1" max="16"
                  class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required />
              </div>
              <div class="flex flex-col space-y-2">
                <label for="comments" class="text-lg font-semibold text-gray-700 flex items-center">
                  <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 7h10M7 12h10M7 17h10M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z">
                    </path>
                  </svg>
                  Comments
                </label>
                <textarea id="comments" v-model="form.comments"
                  class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
              </div>                       
              <strong><p class="text-gray-700" style="font-size: 20px;">Total price for {{ form.people }} people: ${{ calcularPrecioTotal }} USD</p></strong>
              <div class="flex justify-center">
                <button type="submit" class="bg-blue-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">Book now</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <div class="map-container">
      <h2 class="nombre-tour" style="font-size: 25px;">Meeting Place</h2>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7437.072316294123!2d-86.7428208!3d21.2502343!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f4c300370f9450b%3A0xe713a3cbe997ca76!2sDestino%20Island%20Adventure!5e0!3m2!1ses-419!2smx!4v1725170361701!5m2!1ses-419!2smx"
        width="100%" height="400" class="tour-map" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </SimpleLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import SimpleLayout from '@/Layouts/SimpleLayout.vue';
import { computed, ref, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
  tour: Object,
});

const form = ref({
  name: '',
  email: '',
  countryCode: '+52',
  phone: '',
  date: '',
  people: 1,
  comments: '',
});

const calcularPrecioTotal = computed(() => {
  if (form.value.people > props.tour.pax) {
    const excessPassengers = form.value.people - props.tour.pax;
    const pasajerosExtra = excessPassengers * Number(props.tour.extra);
    const precioNuevo = (pasajerosExtra + Number(props.tour.price));
    return precioNuevo;
  }
  
  return Number(props.tour.price);
});

const minDate = new Date().toISOString().split("T")[0];

const handleSubmit = async () => {
  try {
    // Recupera el array de tours del localStorage o inicialízalo si no existe
    const tours = JSON.parse(localStorage.getItem('tours')) || [];

    // Crea un nuevo objeto de tour
    const newTour = {
      tourName: props.tour.tour_name,
      name: form.value.name,
      email: form.value.email,
      phone: form.value.countryCode + form.value.phone,
      date: form.value.date,
      people: form.value.people,
      comments: form.value.comments,
      total: calcularPrecioTotal.value * 100
    };

    // Añade el nuevo tour al array
    tours.push(newTour);

    // Guarda el array actualizado en el localStorage
    localStorage.setItem('tours', JSON.stringify(tours));

    // Actualiza el indicador del carrito
    const event = new Event('cartUpdated');
    window.dispatchEvent(event);
  } catch (error) {
    console.error('Error al realizar la reserva:', error);
    alert('Ocurrió un error al realizar la reserva.');
  }
};

function formatText(text) {
  if (!text) return '';
  return text
    .replace(/\+/g, '🕒')
    .replace(/##(.*?)\n/g, '<strong style="color: darkblue;">$1</strong><br>')
    .replace(/»/g, '<span style="color: orange;">&raquo;</span>')
    .replace(/\n\n/g, '</p><p>')
    .replace(/\~/g, '⚠️')
    .replace(/\{/g, '🚫')
    .replace(/\n/g, '<br>');    
}

const formattedText = ref(formatText(props.tour.descripcion));

// Image carousel logic
const images = ref([]);
const currentIndex = ref(0);

const fetchImages = async () => {
  try {
    const tourId = props.tour.id;
    const response = await axios.get(`/tour-images/${tourId}`);
    images.value = response.data;
  } catch (error) {
    console.error('Error fetching images:', error);
  }
};

const direction = ref('fade'); // Nueva variable para la dirección del deslizadoconst direction = ref('fade'); // Cambia la dirección a 'fade'

const updateCarousel = () => {
  const carouselImages = document.querySelector('.carousel-images');
  if (carouselImages) {
    carouselImages.style.transform = `translateX(-${currentIndex.value * 100}%)`;
  }
};

const prevImage = () => {
  currentIndex.value = (currentIndex.value - 1 + images.value.length) % images.value.length;
  updateCarousel();
};

const nextImage = () => {
  currentIndex.value = (currentIndex.value + 1) % images.value.length;
  updateCarousel();
};

onMounted(() => {
  fetchImages();
  updateCarousel();
});
</script>

<style scoped>
.flex-container {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 20px;
}

.flex-item {
  flex-basis: 48%;
}

.text-section {
  padding-left: 20px;
}

.nombre-tour {
  color: darkblue;
}

.carousel-container {
  position: relative;
  width: 100%;
  max-width: 1350px;
  margin: 0 auto;
  overflow: hidden;
}

.carousel {
  position: relative;
  width: 100%;
}

.carousel-images {
  display: flex;
  transition: transform 0.5s ease-in-out;
}

.carousel-image {
  flex: 1 0 100%;
  height: auto;
  max-height: 565px;
  border-radius: 10px;
  object-fit: cover;
}

.carousel-button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0, 0, 0, 0.62);
  color: white;
  border: none;
  width: 50px;
  height: 50px;
  font-size: 24px;
  cursor: pointer;
  border-radius: 50%;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.carousel-button:hover {
  background-color: rgba(0, 0, 0, 0.8);
  transform: translateY(-50%) scale(1.1);
}

.carousel-prev {
  left: 20px;
}

.carousel-next {
  right: 20px;
}

.carousel-text {
  position: absolute;
  bottom: 20px;
  color: white;
  background-color: rgba(0, 0, 0, 0.5);
  padding: 10px;
  border-radius: 5px;
  z-index: 1;
}

.carousel-text h2 {
  margin: 0;
  font-size: 40px;
  font-weight: bold;
}

.carousel-text p {
  margin: 0;
  font-size: 20px;
  font-weight: lighter;
}

.no-images {
  text-align: center;
  font-size: 18px;
  color: #555;
  margin: 20px 0;
}

.map-container {
  margin-top: 20px;
}

.tour-map {
  border: 0;
}

.max-w-4xl {
  max-width: 4xl;
}

.mx-auto {
  margin-left: auto;
  margin-right: auto;
}

.p-6 {
  padding: 1.5rem;
}

.bg-white {
  background-color: #ffffff;
}

.shadow-lg {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1);
}

.rounded-lg {
  border-radius: 0.5rem;
}

.space-y-6>*+* {
  margin-top: 1.5rem;
}

.text-lg {
  font-size: 1.125rem;
}

.font-semibold {
  font-weight: 600;
}

.text-gray-700 {
  color: #4a5568;
}

.p-3 {
  padding: 0.75rem;
}

.border {
  border-width: 1px;
}

.border-gray-300 {
  border-color: #d1d5db;
}

.rounded-lg {
  border-radius: 0.5rem;
}

.focus\:outline-none:focus {
  outline: 0;
}

.bg-blue-600 {
  background-color: #2563eb;
}

.text-white {
  color: #ffffff;
}

.py-3 {
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
}

.px-6 {
  padding-left: 1.5rem;
  padding-right: 1.5rem;
}

.rounded-lg {
  border-radius: 0.5rem;
}

.shadow-md {
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.hover\:bg-blue-700:hover {
  background-color: #1e40af;
}

.transition-all {
  transition: all 0.3s ease;
}

@media (max-width: 768px) {
  .flex-container {
    flex-direction: column;
    gap: 10px;
  }

  .flex-item {
    flex-basis: 100%;
  }

  .carousel-text h2 {
    font-size: 24px;
  }

  .carousel-text p {
    font-size: 16px;
  }

  .carousel-button {
    width: 40px;
    height: 40px;
    font-size: 20px;
  }

  .carousel-prev {
    left: 10px;
  }

  .carousel-next {
    right: 10px;
  }

  .form-container {
    max-width: 100%;
    padding: 1rem;
  }

  .text-section{
    padding-right: 20px;
  }
}
</style>