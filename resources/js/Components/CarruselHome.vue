<template>
  <div class="carousel-container">
      <div class="carousel">
          <img :src="currentImage" :title="'Tour #' + currentImageIndex" :alt="'Tour #' + currentImageIndex" class="carousel-image" />
      </div>
      <!--<div class="carousel-indicators">
          <span v-for="(image, index) in images" :key="index" class="indicator"
              :class="{ active: index === currentImageIndex }" @click="setCurrentImage(index)"></span>
      </div>-->
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

// Referencia a las imágenes del carrusel
const images = ref([]);

// Estado para manejar el índice de la imagen actual
const currentImageIndex = ref(0); // Inicia desde la primera imagen (índice 0)

// Intervalo para el carrusel automático
let autoSlideInterval = null;

// Función para cargar las imágenes desde la carpeta public/images/logos
const loadImages = () => {
  for (let i = 2; i <= 11; i++) {
      images.value.push(`/images/logos/imagen${i}.jpg`); // Cambia 'logo' por el prefijo de tus imágenes
  }
};

// Devuelve la imagen actual
const currentImage = computed(() => images.value[currentImageIndex.value]);

// Avanza a la siguiente imagen
const nextImage = () => {
  currentImageIndex.value = (currentImageIndex.value + 1) % images.value.length;
};

// Retrocede a la imagen anterior
const prevImage = () => {
  currentImageIndex.value =
      (currentImageIndex.value - 1 + images.value.length) % images.value.length;
};

// Establecer imagen específica
const setCurrentImage = (index) => {
  currentImageIndex.value = index;
};

// Configura el carrusel automático
const startAutoSlide = () => {
  autoSlideInterval = setInterval(nextImage, 3000); // Cambia la imagen cada 3 segundos
};

// Limpia el intervalo cuando el componente se desmonte
const stopAutoSlide = () => {
  if (autoSlideInterval) {
      clearInterval(autoSlideInterval);
  }
};

// Cargar las imágenes y empezar el carrusel automático cuando el componente se monta
onMounted(() => {
  loadImages();
  startAutoSlide();
});

// Limpiar el intervalo cuando el componente se desmonte
onUnmounted(() => {
  stopAutoSlide();
});
</script>

<style scoped>
.carousel-container {
  position: relative;
  width: 100vw; /* Ocupa todo el ancho de la pantalla */
  height: 100vh; /* Ocupa todo el alto de la pantalla */
  margin: 0;
  overflow: hidden;
}

.carousel {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
}

.carousel-image {
  width: 100%;
  height: 100%;
  object-fit: cover; /* Asegura que la imagen cubra todo el contenedor */
}

/* Botones del carrusel */
.prev, .next {
position: absolute;
top: 50%;
transform: translateY(-50%);
background-color: rgba(0, 0, 0, 0.62); /* Fondo semi-transparente */
color: white;
border: none;
width: 50px; /* Ancho fijo para que sea circular */
height: 50px; /* Alto fijo para que sea circular */
font-size: 24px; /* Tamaño del ícono */
cursor: pointer;
border-radius: 50%; /* Botón completamente redondo */
transition: background-color 0.3s ease, transform 0.3s ease; /* Transición para el fondo y tamaño */
}

.prev:hover, .next:hover {
background-color: rgba(0, 0, 0, 0.8); /* Fondo más oscuro en hover */
transform: translateY(-50%) scale(1.1); /* Aumento en hover */
}

/* Posición de los botones */
.prev {
left: 20px; /* Posición a la izquierda */
}

.next {
right: 20px; /* Posición a la derecha */
}

/* Estilos para los indicadores del carrusel */
.carousel-indicators {
display: flex;
justify-content: center;
margin-top: 10px;
}

.indicator {
height: 15px;
width: 15px;
margin: 0 5px;
background-color: rgba(0, 0, 0, 0.5);
border-radius: 50%;
display: inline-block;
cursor: pointer;
transition: background-color 0.3s ease;
}

.indicator.active {
background-color: #ffcc00; /* Color de indicador activo */
}

.indicator:hover {
background-color: rgba(0, 0, 0, 0.8);
}

@media (max-width: 768px) {
.carousel-container {
  height: 1vh; /* Mantiene la altura completa en pantallas pequeñas */
  width: 100vw; /* Mantiene el ancho completo en pantallas pequeñas */
}

.carousel-image {
  object-fit: cover; /* Asegura que la imagen cubra todo el contenedor */
}

.prev, .next {
  width: 40px; /* Ajusta el tamaño de los botones para pantallas pequeñas */
  height: 40px;
  font-size: 20px;
}
}

/* Estilos responsivos */
@media (max-width: 1000px) {
.carousel-container {
  height: 61vh; /* Mantiene la altura completa en pantallas pequeñas */
  width: 100vw; /* Mantiene el ancho completo en pantallas pequeñas */
}

.carousel-image {
  object-fit: cover; /* Asegura que la imagen cubra todo el contenedor */
}

.prev, .next {
  width: 40px; /* Ajusta el tamaño de los botones para pantallas pequeñas */
  height: 40px;
  font-size: 20px;
}
}
</style>