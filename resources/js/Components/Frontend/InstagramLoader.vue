<template>
    <span class="loader"></span>
</template>

<script>
export default {};
</script>

<style scoped>
.loader {
    position: relative;
    width: 100%;
    height: 25rem;
    display: block;
    border: 1px solid #bebebe;
    border-radius: 1rem;
}
.loader::after {
    content: "";
    width: calc(100% - 30px);
    height: calc(100% - 15px);
    top: 15px;
    left: 15px;
    position: absolute;
    background-image: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, 0.5) 50%,
            transparent 100%
        ),
        linear-gradient(#ddd 100px, transparent 0),
        linear-gradient(#ddd 16px, transparent 0),
        linear-gradient(#ddd 50px, transparent 0);
    background-repeat: no-repeat;
    background-size: 75px 175px, 100% 100px, 100% 16px, 100% 30px;
    background-position: -185px 0, center 0, center 115px, center 142px;
    animation: animloader 1s linear infinite;
}

@keyframes animloader {
    to {
        background-position: 185px 0, center 0, center 115px, center 142px;
    }
}
</style>
