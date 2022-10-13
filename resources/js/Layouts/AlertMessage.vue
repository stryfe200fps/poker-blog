<template>
    <div class="alert-msg" @click="scrollToTop">New Reports added.</div>
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
    color: #000;
    cursor: pointer;
}
</style>
