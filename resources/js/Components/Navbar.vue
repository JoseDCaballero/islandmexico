<script setup>
import Cart from './Cart.vue';
import { ref } from 'vue';

const isMenuOpen = ref(false);
const activeDropdown = ref(null);
const isSmallScreen = ref(window.innerWidth <= 1276);

function toggleMenu() {
    isMenuOpen.value = !isMenuOpen.value;
}

function toggleDropdown(index) {
    if (isSmallScreen.value) {
        activeDropdown.value = activeDropdown.value === index ? null : index;
    }
}

window.addEventListener('resize', () => {
    isSmallScreen.value = window.innerWidth <= 1276;
});
</script>

<template>
    <div class="empresa">
        <h1>Island Adventures México</h1>        
    </div>
    <nav class="navbar">
        <div class="navbar-logo">
            <a href="/"><img src="/images/logoisland.png" id="logo" title="Adventures Island"></a>
        </div>
        <button class="navbar-toggle" @click="toggleMenu">☰</button>
        <ul class="navbar-links" :class="{ 'navbar-links-active': isMenuOpen }">
            <li class="dropdown" @click="toggleDropdown(0)">
                <a href="/">Home</a>
            </li>
            <li class="dropdown" @click="toggleDropdown(1)">
                <a>Snorkel tours</a>
                <ul class="dropdown-menu" v-if="activeDropdown === 1 || !isSmallScreen.value">
                    <li><a href="/tours/xtreme-snorkel-vip">Xtreme snorkel VIP</a></li>
                    <li><a href="/tours/xtreme-snorkel-shared">Xtreme snorkel shared</a></li>
                    <li><a href="/tours/xtreme-snorkel-private">Xtreme snorkel private</a></li>
                    <li><a href="/tours/sunrise-snorkeling">Sunrise snorkeling</a></li>
                </ul>
            </li>
            <li class="dropdown" @click="toggleDropdown(2)">
                <a>Whale shark</a>
                <ul class="dropdown-menu" v-if="activeDropdown === 2 || !isSmallScreen.value">
                    <li><a href="/tours/shark-tour">Tour private</a></li>
                    <li><a href="/tours/shark-tour-im">Tour from Isla Mujeres</a></li>
                    <li><a href="/tours/shark-tour-cancun">Tour from Cancún</a></li>
                    <li><a href="/tours/shark-tour-pcrm">Tour from Playa del Carmen</a></li>
                </ul>
            </li>
            <li class="dropdown" @click="toggleDropdown(3)">
                <a>Top tours</a>
                <ul class="dropdown-menu" v-if="activeDropdown === 3 || !isSmallScreen.value">
                    <li><a href="/tours/xtreme-snorkel-vip">Xtreme snorkel VIP</a></li>
                    <li><a href="/tours/xtreme-snorkel-shared">Xtreme snorkel shared</a></li>
                    <li><a href="/tours/xtreme-snorkel-private">Xtreme snorkel private</a></li>
                    <li><a href="/tours/shark-tour">Whale shark private</a></li>
                    <li><a href="/tours/catamaran-tour">Catamaran private</a></li>
                </ul>
            </li>
            <li class="dropdown" @click="toggleDropdown(4)">
                <a href="/open-payment">Open payment</a>
            </li>
            <li class="dropdown" @click="toggleDropdown(5)">
                <a href="/tours">Tours</a>
            </li>
            <li class="dropdown" @click="toggleDropdown(6)">
                <a href="/reviews-&-comments">Reviews</a>
            </li>
            <li class="dropdown" @click="toggleDropdown(7)">
                <a href="/contact">Contact</a>
            </li>
        </ul>
        <Cart />
    </nav>
</template>

<style scoped>
.navbar {
    position: sticky;
    top: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #18656E, #2295a2);
    background-size: cover;
    background-position: center;
    color: white;
    height: 120px;
    padding: 0 2rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    z-index: 1000;
    transition: background 0.3s ease;
    overflow: visible;
    border: none;
}

.navbar-logo {
    display: flex;
    align-items: center;
}

.navbar-logo img {
    width: 80px;
    height: auto;
    transition: transform 0.3s ease;
}

.navbar-logo img:hover {
    transform: scale(1.1) rotate(10deg);
}

.navbar-toggle {
    display: none;
    font-size: 1.5rem;
    background: none;
    border: none;
    color: white;
    cursor: pointer;
}

.navbar-links {
    list-style: none;
    display: flex;
    gap: 2rem;
}

.navbar-links li {
    position: relative;
}

.navbar-links a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    font-weight: bold;
    position: relative;
    padding: 0.5rem;
    transition: color 0.3s ease;
}

.navbar-links a:hover {
    color: #ffcc00;
    cursor: pointer;
}

.navbar-links a::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 3px;
    background: #ffcc00;
    bottom: -5px;
    left: 0;
    transform: scaleX(0);
    transform-origin: right;
    transition: transform 0.3s ease;
}

.navbar-links a:hover::after {
    transform: scaleX(1);
    transform-origin: left;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 120%;
    left: 0;
    background-color: rgba(0, 0, 0, 0.8);
    padding: 1rem;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    z-index: 2000;    
}

.dropdown:hover .dropdown-menu {
    display: block;
    animation: fadeIn 0.3s ease;
}

.dropdown-menu li {
    margin: 0.5rem 0;
}

.dropdown-menu a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    display: block;
    transition: color 0.3s ease;
}

.dropdown-menu a:hover {
    color: #ffcc00;
}

.empresa {
    background: linear-gradient(135deg, #18656E, #2295a2);
    color: #fff;
}

.navbar-links-active {
    background-color: rgba(0, 0, 0, 0.9);
    padding: 1rem 0;
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    z-index: 999;
}

@media (max-width: 1276px) {
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }

    .navbar-logo {
        flex: 1;
        display: flex;
        justify-content: flex-start; /* Logo alineado a la izquierda */
    }

    .navbar-toggle {
        flex: 0;
        position: absolute; /* Centramos el botón absolutamente */
        left: 54%; /* Mover el botón al centro horizontal */
        transform: translateX(-50%); /* Ajustamos el botón para que esté perfectamente centrado */
        display: block;
        font-size: 1.5rem;
        background: none;
        border: none;
        color: white;
        cursor: pointer;
    }

    .navbar-cart {
        flex: 1;
        display: flex;
        justify-content: flex-end; /* Carrito alineado a la derecha */
    }

    .navbar-links {
        display: none;
        flex-direction: column;
        width: 100%;
    }

    .navbar-links-active {
        display: flex;
        background: linear-gradient(135deg, #18656E, #2295a2);
    }

    .navbar-links li {
        margin: 0;
        text-align: center;
    }

    .navbar-links-active li {
        margin: 0.0rem 0;
    }

    .dropdown-menu {
        position: static;
    }
}
</style>