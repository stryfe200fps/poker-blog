<template>
    <button
        class="hamburger hamburger--spin"
        :class="{ 'is-active': toggleMenu }"
        type="button"
        @click="toggleBtn"
    >
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
    </button>
</template>

<script setup>
const props = defineProps({
    toggleMenu: {
        type: Boolean,
    },
});

const emit = defineEmits(["toggleBtn"]);

function toggleBtn() {
    emit("toggleBtn");
}
</script>

<style scoped>
.hamburger {
    overflow: visible;
    display: none;
    font: inherit;
    text-transform: none;
    color: inherit;
    background-color: transparent;
    border: 0;
    cursor: pointer;
    transition-property: opacity, filter;
    transition-duration: 0.15s;
    transition-timing-function: linear;
}

.hamburger:hover {
    opacity: 0.7;
}

.hamburger.is-active:hover {
    opacity: 0.7;
}

.hamburger.is-active .hamburger-inner,
.hamburger.is-active .hamburger-inner::before,
.hamburger.is-active .hamburger-inner::after {
    background-color: #fff;
}

.hamburger-box {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 24px;
}

.hamburger-inner {
    top: 50%;
    display: block;
    margin-top: -2px;
}

.hamburger-inner,
.hamburger-inner::before,
.hamburger-inner::after {
    position: absolute;
    width: 35px;
    height: 3px;
    background-color: #fff;
    border-radius: 4px;
    transition: transform 0.15s ease;
}

.hamburger-inner::before,
.hamburger-inner::after {
    content: "";
    display: block;
}

.hamburger-inner::before {
    top: -10px;
}

.hamburger-inner::after {
    bottom: -10px;
}

.hamburger--spin .hamburger-inner {
    transition-duration: 0.22s;
    transition-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
}

.hamburger--spin .hamburger-inner::before {
    transition: top 0.1s 0.25s ease-in, opacity 0.1s ease-in;
}

.hamburger--spin .hamburger-inner::after {
    transition: bottom 0.1s 0.25s ease-in,
        transform 0.22s cubic-bezier(0.55, 0.055, 0.675, 0.19);
}

.hamburger--spin.is-active .hamburger-inner {
    transform: rotate(225deg);
    transition-delay: 0.12s;
    transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
}

.hamburger--spin.is-active .hamburger-inner::before {
    top: 0;
    opacity: 0;
    transition: top 0.1s ease-out, opacity 0.1s 0.12s ease-out;
}

.hamburger--spin.is-active .hamburger-inner::after {
    bottom: 0;
    transform: rotate(-90deg);
    transition: bottom 0.1s ease-out,
        transform 0.22s 0.12s cubic-bezier(0.215, 0.61, 0.355, 1);
}

@media screen and (max-width: 767px) {
    .hamburger {
        display: inline-block;
    }
}
</style>
