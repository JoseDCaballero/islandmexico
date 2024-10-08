<script>
import Navbar from '../Components/Navbar.vue';

export default {
  components: {
    Navbar
  }
}
</script>
<template>    
    <main>
        <Navbar />
        <slot /> 
    </main>   
</template>