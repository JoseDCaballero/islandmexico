<template>
    <div>
        <form @submit.prevent="handlePayment">
            <!-- Instrucción clara para el usuario -->
            <label for="card-element">Introduce your data card:</label>
            <div id="card-element"></div>
            <!-- Mostrar mensajes de error si existen -->
            <p v-if="cardError" class="error">{{ cardError }}</p>
            <!-- Botón de pago con estado de carga -->
            <button :disabled="isLoading" type="submit" class="pagar">
                {{ isLoading ? 'Procesando...' : 'Pay' }}
            </button>
        </form>
        <!-- Mostrar mensaje de éxito o error al realizar el pago -->
        <p v-if="paymentStatus">{{ paymentStatus }}</p>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { loadStripe } from '@stripe/stripe-js';
import axios from 'axios';

const props = defineProps({
  total: {
    type: Number,
    required: true
  },
  tourName: {
    type: String,
    required: true
  },
  name: {
    type: String,
    required: true
  },
  email: {
    type: String,
    required: true
  },
  phone: {
    type: String,
    required: true
  },
  date: {
    type: String,
    required: true
  },
  people: {
    type: Number,
    required: true
  },
  comments: {
    type: String,
    required: false
  }
});

// Cargar la clave pública de Stripe desde el archivo .env
const stripePromise = loadStripe(import.meta.env.VITE_STRIPE_PUBLIC_KEY);
const cardElement = ref(null);
const isLoading = ref(false);
const cardError = ref('');
const paymentStatus = ref('');

onMounted(async () => {
    const stripe = await stripePromise;
    const elements = stripe.elements();

    // Crear el elemento de la tarjeta
    cardElement.value = elements.create('card');
    cardElement.value.mount('#card-element');

    // Manejar errores de validación en el campo de la tarjeta
    cardElement.value.on('change', (event) => {
        if (event.error) {
            cardError.value = event.error.message;
        } else {
            cardError.value = '';
        }
    });
});

const handlePayment = async () => {
    isLoading.value = true;
    paymentStatus.value = ''; // Resetear el estado del mensaje de pago

    try {
        // Solicitar al backend que cree el Payment Intent
        const { data } = await axios.post('/create-payment-intent', {
            amount: props.total, 
        });

        const stripe = await stripePromise;

        // Confirmar el pago con la tarjeta ingresada
        const { error, paymentIntent } = await stripe.confirmCardPayment(data.clientSecret, {
            payment_method: {
                card: cardElement.value,
            },
        });
        
        if (error) {
            cardError.value = error.message; // Mostrar mensaje de error en la interfaz
        } else if (paymentIntent.status === 'succeeded') {
            paymentStatus.value = 'Payment completed successfully';

            try {
                // Enviar los datos del tour al backend
                await axios.post('/sales', {
                    tour_name: props.tourName,
                    pax: props.people,
                    price: props.total, // Convertir a la unidad adecuada si es necesario
                    fecha: props.date,
                    email: props.email,
                    phone: props.phone,
                    comments: props.comments,
                    nombre: props.name
                });

                alert("Tour guardado correctamente en la base de datos");
                // Limpiar localStorage y refrescar la página
                localStorage.removeItem("tours");                           
                window.location.reload();   
            } catch (error) {
                console.error("Error guardando el tour en la base de datos:", error);
                alert("Error al guardar el tour en la base de datos");
            }
        }
    } catch (error) {
        paymentStatus.value = 'Error al procesar el pago'; // Manejar errores del backend
        alert("Ocurrió un error");
    } finally {
        isLoading.value = false; // Habilitar el botón nuevamente
    }
};
</script>

<style scoped>
.error {
    color: red;
}

.pagar {
    background-color: #4CAF50;
    padding: 10px;
    border-radius: 20px;
    color: #fff;
}

.pagar:hover {
    background-color: #3b843d;
    cursor: pointer;
}
</style>