<template>
    <div class="loader" v-if="isLoading"></div>
    <div class="translate-container">
        <div id="google_translate_element"></div>
    </div>
</template>

<script setup>
const props = defineProps({
    isLoading: {
        type: Boolean,
    },
});
</script>

<style scoped>
.translate-container {
    position: absolute;
    right: 0;
}

.loader {
    position: absolute;
    right: 30px;
    width: 26px;
    height: 26px;
    border: 2px solid #fff;
    border-left-color: transparent;
    border-radius: 50%;
    animation: spin89345 1s linear infinite;
}

@keyframes spin89345 {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

@media screen and (max-width: 767px) {
    .translate-container {
        position: static;
        right: unset;
    }

    .loader {
        right: 10px;
        bottom: 0;
    }
}
</style>
