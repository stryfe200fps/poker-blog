<template>
    <div
        class="home-banner"
        v-if="
            formattedReportingBanner &&
            (url.includes('live-reporting') ||
                currentComponent === 'Event/Index')
        "
        :style="{
            backgroundImage: `url(${formattedReportingBanner.image_set?.og_image})`,
            cursor: formattedReportingBanner.url ? 'pointer' : 'auto',
        }"
        @click="visitBanner(formattedReportingBanner.url)"
    ></div>
    <div
        class="home-banner"
        v-if="
            formattedHomeBanner && currentComponent === 'Index' && url === '/'
        "
        :style="{
            backgroundImage: `url(${formattedHomeBanner.image_set?.og_image})`,
            cursor: formattedHomeBanner.url ? 'pointer' : 'auto',
        }"
        @click="visitBanner(formattedHomeBanner.url)"
    ></div>
</template>

<script setup>
const props = defineProps({
    formattedHomeBanner: {
        type: Object,
    },
    formattedReportingBanner: {
        type: Object,
    },
    url: {
        type: String,
    },
    currentComponent: {
        type: String,
    },
});

function visitBanner(url) {
    if (url) window.open(url, "_blank");
}
</script>

<style scoped>
.home-banner {
    position: fixed;
    inset: 0;
    width: 100%;
    min-height: 100vh;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: top center;
    image-rendering: -webkit-optimize-contrast;
}

@media (max-width: 1599px) {
    .home-banner {
        display: none;
    }
}
</style>
