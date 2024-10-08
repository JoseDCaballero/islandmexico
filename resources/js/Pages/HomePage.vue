<script setup>
import SimpleLayout from '@/Layouts/SimpleLayout.vue'
import { Head } from '@inertiajs/vue3';
import CarruselHome from '@/Components/CarruselHome.vue';
</script>

<template>
    <Head title="Island Adventures Home" />
    <SimpleLayout>
        <section>
            <h5 class="subtitle">Welcome to</h5>
            <h2 class="main-title">ISLAND ADVENTURES MEXICO</h2>
            <CarruselHome />
            <div class="text-container">
                <p class="text">Island Adventures Mexico, is a 100% family business located in the beautiful Isla Mujeres, Q. Roo. We have more than 15 years of experience in the service of tours, snorkeling, swimming with whale sharks and many more adventures.</p><br>
                <p class="text">We will take you to the most beautiful places in Isla Mujeres, you will swim in crystal clear waters, you will see a great variety of fish, you will taste an excellent food, and if you like fish; we are experts in it. Come and be impressed by the great adventures that our team and Isla Mujeres have for you and your family.</p>
            </div>
            <div class="more-text">
                <h1>We´re your best choice</h1>
                <h1>Why to choose us?</h1>
                <div>
                    <h1>Lowest price guaranted</h1>
                </div>
            </div>
        </section>
        <figure class="wpb_wrapper vc_figure">
            <a href="https://www.tripadvisor.com/Attraction_Review-g150810-d6871538-Reviews-Island_Adventures_Mexico-Isla_Mujeres_Yucatan_Peninsula.html" target="_blank" class="vc_single_image-wrapper vc_box_border_grey">
                <img loading="lazy" decoding="async" width="1752" height="528" src="https://islandadventuresmexico.com/wp-content/uploads/2022/11/tripadivors-2.jpg" class="vc_single_image-img attachment-full" alt="" sizes="(max-width: 1752px) 100vw, 1752px" />
            </a>
        </figure>
    </SimpleLayout>
</template>

<style scoped>

.subtitle {
    font-family: cursive;
    font-size: 4vw;
    margin: 0;
}

.main-title {
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    font-size: 6vw;
    margin: 0;
}

.text-container {
    padding-top: 30px;
}

.text {
    font-size: 3.5vw;
}

.more-text {
    padding-top: 30px;
}

figure {
    width: 100%;
    margin: 20px 0;
}

img {
    width: 100%;
    height: auto;
}

@media (min-width: 900px) {
    .subtitle {
        font-size: 20px;
    }

    .main-title {
        font-size: 40px;
    }

    .text {
        font-size: 17px;
    }
}
</style>
