<script setup>
import SimpleLayout from '@/Layouts/SimpleLayout.vue';
import { Head } from '@inertiajs/vue3';
import Pagos from '@/Components/Pagos.vue';

const pagar = () => {
    const precio = document.getElementById('precio').value;
    localStorage.setItem("Total", precio);
}

const borrar = () => {
    localStorage.removeItem("Total");
    alert("Borrado")
}

const cantidadPuesta = localStorage.getItem("Total")
</script>
<template>
    <Head title="Open payment"/>
    <SimpleLayout>
        <h2>Type your data</h2>
        <div class="formulario">
            <form @submit.prevent="pagar">
                <input>
                <input id="precio">
                <button type="submit">Continue</button> 
            </form>
        </div>     
        <button @click="borrar()">borrar</button>
        <div v-if="cantidadPuesta">
            <Pagos />    
        </div>           
    </SimpleLayout>
</template>
<style scoped>
</style>