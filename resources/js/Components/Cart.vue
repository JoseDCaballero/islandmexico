<script setup>
import { ref, onMounted } from 'vue';

const hasItemsInCart = ref(false);

const updateCartIndicator = () => {
  const cartItems = JSON.parse(localStorage.getItem('tours')) || [];
  hasItemsInCart.value = cartItems.length > 0;
};

onMounted(() => {
  updateCartIndicator();
  window.addEventListener('cartUpdated', updateCartIndicator);
});
</script>

<template>
  <div class="cart-container">
    <a href="/cart">
      <i class="fas fa-shopping-cart"></i> <!-- Icono de carrito -->
      <span v-if="hasItemsInCart" class="cart-indicator"></span>
    </a>
  </div>
</template>

<style scoped>
.cart-container {
  position: relative;
  height: 40px; /* Ajusta según sea necesario */
}

i {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 24px; /* Ajusta el tamaño del icono */
}

.cart-indicator {
  position: absolute;
  top: 0;
  right: 0;
  width: 10px;
  height: 10px;
  background-color: red;
  border-radius: 50%;
}
</style>