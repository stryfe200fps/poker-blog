<template>
    <div
        class="home-banner"
        v-if="formattedReportingBanner && currentComponent === 'Event/Index'"
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
    <div
        class="home-banner"
        v-if="
            formattedLiveReportingBanner &&
            currentComponent === 'Tournament/Index'
        "
        :style="{
            backgroundImage: `url(${formattedLiveReportingBanner.image_set?.og_image})`,
            cursor: formattedLiveReportingBanner.url ? 'pointer' : 'auto',
        }"
        @click="visitBanner(formattedLiveReportingBanner.url)"
    ></div>
    <div
        class="home-banner"
        v-if="
            formattedEventCalendarBanner &&
            currentComponent === 'Event/EventCalendar'
        "
        :style="{
            backgroundImage: `url(${formattedEventCalendarBanner.image_set?.og_image})`,
            cursor: formattedEventCalendarBanner.url ? 'pointer' : 'auto',
        }"
        @click="visitBanner(formattedEventCalendarBanner.url)"
    ></div>
    <div
        class="home-banner"
        v-if="
            formattedPokerRoomBanner &&
            (currentComponent === 'Template/Index' ||
                currentComponent === 'Template/PokerRoom') &&
            (url.includes('poker-rooms') || url.includes('rooms'))
        "
        :style="{
            backgroundImage: `url(${formattedPokerRoomBanner.image_set?.og_image})`,
            cursor: formattedPokerRoomBanner.url ? 'pointer' : 'auto',
        }"
        @click="visitBanner(formattedPokerRoomBanner.url)"
    ></div>
    <div
        class="home-banner"
        v-if="
            formattedPokerTourBanner &&
            (currentComponent === 'Template/Index' ||
                currentComponent === 'Template/PokerTour') &&
            url.includes('tours')
        "
        :style="{
            backgroundImage: `url(${formattedPokerTourBanner.image_set?.og_image})`,
            cursor: formattedPokerTourBanner.url ? 'pointer' : 'auto',
        }"
        @click="visitBanner(formattedPokerTourBanner.url)"
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
    formattedLiveReportingBanner: {
        type: Object,
    },
    formattedEventCalendarBanner: {
        type: Object,
    },
    formattedPokerRoomBanner: {
        type: Object,
    },
    formattedPokerTourBanner: {
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
