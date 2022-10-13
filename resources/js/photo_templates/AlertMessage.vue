<template>
    <div class="alert-msg" @click="handleAlertReport">
        New post - click here
    </div>
</template>

<script setup>
const handleAlertReport = () => {
    window.scroll({ top: 0, behavior: "smooth" });
};
</script>

<style>
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
