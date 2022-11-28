<template>
    <ul class="nav nav-tabs custom-tabs">
        <li
            @click.prevent="changeTab(currentTab)"
            :class="{
                active: currentTab == null,
            }"
        >
            <Link
                :href="`/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/${dayValue}`"
                data-toggle="tab"
                preserve-state
            >
                <span class="hide-on-mobile">LIVE UPDATES</span>
                <span class="show-on-mobile">UPDATES</span>
            </Link>
        </li>

        <li
            @click="changeTab(currentTab)"
            :class="{ active: currentTab == 'chip-stack' }"
        >
            <Link
                :href="`/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/${dayValue}/chip-stack`"
                data-toggle="tab"
                preserve-state
            >
                <span class="hide-on-mobile">CHIP COUNTS</span>
                <span class="show-on-mobile">CHIPS</span>
            </Link>
        </li>
        <li
            @click="changeTab(currentTab)"
            :class="{ active: currentTab == 'whatsapp' }"
        >
            <Link
                :href="`/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/${dayValue}/whatsapp`"
                data-toggle="tab"
                preserve-state
                >#WHATSAPP</Link
            >
        </li>
        <li
            @click="changeTab(currentTab)"
            :class="{ active: currentTab == 'gallery' }"
        >
            <Link
                :href="`/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/${dayValue}/gallery`"
                data-toggle="tab"
                preserve-state
                >GALLERY</Link
            >
        </li>
        <li
            @click="changeTab(currentTab)"
            :class="{ active: currentTab == 'payouts' }"
        >
            <Link
                :href="`/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/payouts`"
                data-toggle="tab"
                preserve-state
                >PAYOUTS</Link
            >
        </li>
    </ul>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/runtime-core";

const props = defineProps({
    currentTab: {
        type: String,
    },
    event: {
        type: Object,
    },
    dayValue: {
        type: String,
    },
});

const tab = ref("");

function changeTab(currentTab) {
    tab.value = currentTab;
}
</script>

<style scoped>
.custom-tabs {
    position: sticky;
    position: -webkit-sticky;
    top: 0;
    z-index: 999;
    transition: all 0.5s ease;
}

.single-post-box .about-more-autor ul.nav-tabs {
    margin-bottom: 20px;
}

@media (min-width: 769px) {
    .show-on-mobile {
        display: none;
    }
}
</style>
