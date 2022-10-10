<template>
    <p class="alert-msg" @click="scrollToTop">New Reports added.</p>
</template>

<script setup>
const scrollToTop = () => {
    window.scroll({ top: 0, behavior: "smooth" });
};
</script>

<style scoped>
.alert-msg {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    height: 100%;
    font-size: 1.75rem;
    font-weight: 500;
    color: #fff;
    cursor: pointer;
}
</style>
