<template>
    <div class="scroll-top">
        <button @click="scrollToTop" class="btn btn-danger scroll-top-btn">
            <i class="fa-sharp fa-solid fa-chevron-up"></i>
        </button>
    </div>
</template>

<script setup>
function scrollToTop() {
    window.scroll({ top: 0, behavior: "smooth" });
}
</script>

<style scoped>
.scroll-top {
    position: fixed;
    bottom: 50px;
    right: 50px;
    z-index: 999;
    display: none;
    transition: all 0.5s ease;
}

.scroll-top-btn {
    box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.15);
}

.scroll-top-btn:focus {
    outline: none;
}

@media (max-width: 452px) {
    .scroll-top {
        bottom: 20px;
        right: 20px;
    }
}
</style>
