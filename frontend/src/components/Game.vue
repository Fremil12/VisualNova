<script module>
import { ref } from 'vue';
import axios from 'axios';



</script>

<template>
    <section>
        <img src="" alt="Picture">
        <p>
            Hello world
        </p>
        <button v-for="b in 4">
            option
        </button>
    </section>
</template>

<style scoped>
section {
    border: 1px solid #707070;
    border-radius: 16px;
    box-shadow: #707070a9 0px 1px 1px;
    padding: 10px;
    width: 25%;
}
</style>
