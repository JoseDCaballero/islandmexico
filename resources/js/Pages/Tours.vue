<script setup>
import SimpleLayout from '@/Layouts/SimpleLayout.vue'
import { Head } from '@inertiajs/vue3';
import Tours from '@/Components/Tours.vue';
</script>

<template>
    <Head title="Todos los tours" />
    <SimpleLayout>        
        <h1>Tours</h1>
        <Tours />  
    </SimpleLayout>
</template>

<style scoped>
img {
    width: 100%;
    height: auto;
}
section {
    display:inline;
    flex-direction: row;
}

#tour {
    display: flex;
    align-items: center; /* Centra verticalmente el contenido */
    justify-content: space-between; /* Espacia el contenido horizontalmente */
    background-color: beige;
    padding-right: 15px;
    margin-bottom: 40px;
    width: 100%;
    max-width: 1150px;
    box-shadow: 1px 2px 3px 2px;
    box-sizing: border-box; 
}

.tour-info {
    width: 100%; /* Asegura que ocupe todo el espacio disponible */
    text-align: center; /* Centra el texto horizontalmente */
    margin-left: 30px; /* Centra horizontalmente */
    margin-right: auto; /* Centra horizontalmente */
}

.separator {
    width: 1px;
    height: 200px; /* Ajusta la altura según el contenido */
    background-color: #ccc;
    margin: 0 20px;
    display: inline-block;
}

.tour-details {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

h2 {
    font-size: 20px;
}

.btn-reserve {
    align-self: center; 
    padding: 10px 20px;
    background-color: #1bbbff;
    color: white;
    border: none;    
    border-radius: 25px;
    font-size: 16px;
    margin-top: 10px;
}

.btn-reserve:hover {
    background-color: #0056b3;
    cursor: pointer;
}

@media (max-width: 768px) {
    #tour {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .tour-info {
        margin-left: 0;
        margin-top: 10px;
    }

    .btn-reserve {
        margin-top: 10px;
    }

    .tour-details {
        margin-top: 20px;
    }
}
</style>