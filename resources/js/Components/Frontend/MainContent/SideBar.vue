<template>
    <div class="sidebar">
        <div class="widget social-widget">
            <div class="title-section">
                <h1><span>Stay Connected</span></h1>
            </div>
            <SocialButtons />
        </div>
        <div
            class="advertisement"
            v-if="reportingSideBanner && currentComponent === 'Event/Index'"
            :style="{ cursor: reportingSideBanner.url ? 'pointer' : 'auto' }"
            @click="visitBanner(reportingSideBanner.url)"
        >
            <BannerCard :banner="reportingSideBanner" />
        </div>
        <div
            class="advertisement"
            v-if="homeSideBanner && url === '/' && currentComponent === 'Index'"
            :style="{ cursor: homeSideBanner.url ? 'pointer' : 'auto' }"
            @click="visitBanner(homeSideBanner.url)"
        >
            <BannerCard :banner="homeSideBanner" />
        </div>
        <div
            class="advertisement"
            v-if="
                liveReportingSideBanner &&
                currentComponent === 'Tournament/Index'
            "
            :style="{
                cursor: liveReportingSideBanner.url ? 'pointer' : 'auto',
            }"
            @click="visitBanner(liveReportingSideBanner.url)"
        >
            <BannerCard :banner="liveReportingSideBanner" />
        </div>
        <div
            class="advertisement"
            v-if="
                eventCalendarSideBanner &&
                currentComponent === 'Event/EventCalendar'
            "
            :style="{
                cursor: eventCalendarSideBanner.url ? 'pointer' : 'auto',
            }"
            @click="visitBanner(eventCalendarSideBanner.url)"
        >
            <BannerCard :banner="eventCalendarSideBanner" />
        </div>
        <div
            class="advertisement"
            v-if="
                pokerRoomSideBanner &&
                (currentComponent === 'Template/Index' ||
                    currentComponent === 'Template/PokerRoom') &&
                (url.includes('poker-rooms') || url.includes('rooms'))
            "
            :style="{
                cursor: pokerRoomSideBanner.url ? 'pointer' : 'auto',
            }"
            @click="visitBanner(pokerRoomSideBanner.url)"
        >
            <BannerCard :banner="pokerRoomSideBanner" />
        </div>
        <div
            class="advertisement"
            v-if="
                pokerTourSideBanner &&
                (currentComponent === 'Template/Index' ||
                    currentComponent === 'Template/PokerTour') &&
                url.includes('tours')
            "
            :style="{
                cursor: pokerTourSideBanner.url ? 'pointer' : 'auto',
            }"
            @click="visitBanner(pokerTourSideBanner.url)"
        >
            <BannerCard :banner="pokerTourSideBanner" />
        </div>
        <div class="widget social-widget">
            <div class="title-section">
                <h1><span>twitter</span></h1>
            </div>
            <div
                class="news-post video-post"
                v-for="(tweet, index) in tweetIDs"
                :key="index"
            >
                <TwitterCard :tweet="tweet" />
            </div>
        </div>
        <div class="widget social-widget">
            <div class="title-section">
                <h1><span>instagram</span></h1>
            </div>
            <div class="news-post video-post">
                <div v-if="igFeed">
                    <InstagramCard :link="igLink" />
                </div>
                <div v-else>
                    <InstagramLoader />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage } from "@inertiajs/inertia-vue3";
import { useTwitterStore } from "@/Stores/twitter.js";
import { useIGStore } from "@/Stores/instagram.js";
import { computed, onMounted, ref, watch } from "@vue/runtime-core";

import SocialButtons from "../SocialButtons.vue";
import BannerCard from "../BannerCard.vue";
import TwitterCard from "../TwitterCard.vue";
import InstagramCard from "../InstagramCard.vue";
import InstagramLoader from "../InstagramLoader.vue";

const props = defineProps({
    homeSideBanner: {
        type: Object,
    },
    reportingSideBanner: {
        type: Object,
    },
    liveReportingSideBanner: {
        type: Object,
    },
    eventCalendarSideBanner: {
        type: Object,
    },
    pokerRoomSideBanner: {
        type: Object,
    },
    pokerTourSideBanner: {
        type: Object,
    },
});

const twitterStore = useTwitterStore();
const tweetIDs = ref(null);
const igStore = useIGStore();
const igFeed = ref(null);

const igLink = computed(() => {
    return igFeed.value?.find((ig) => ig.permalink).permalink;
});

const url = computed(() => {
    return usePage().url.value;
});

const currentComponent = computed(() => {
    return usePage().component.value;
});

function visitBanner(url) {
    if (url) window.open(url, "_blank");
}

onMounted(async () => {
    await twitterStore.getTweetID();
    await igStore.getIGFeed();
});

watch(
    () => [twitterStore.tweetIDs, igStore.igFeed],
    function () {
        tweetIDs.value = twitterStore.tweetIDs.data;
        igFeed.value = igStore.igFeed?.data;
    }
);
</script>
