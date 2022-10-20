<template>
    <div class="about-more-autor">
        <ul class="nav nav-tabs custom-tabs">
            <li
                @click.prevent="changeTab(currentTab)"
                :class="{ active: currentTab == 'live' }"
            >
                <Link
                    href="/tournament/live"
                    data-toggle="tab"
                    preserve-state
                    style="cursor: pointer"
                    ><span class="hidden-xs">live events</span
                    ><span class="visible-xs">live</span></Link
                >
            </li>
            <li
                @click.prevent="changeTab(currentTab)"
                :class="{ active: currentTab == 'past' }"
            >
                <Link href="/tournament/past" data-toggle="tab" preserve-state
                    ><span class="hidden-xs">past events</span
                    ><span class="visible-xs">past</span>
                </Link>
            </li>
            <li
                @click.prevent="changeTab(currentTab)"
                :class="{ active: currentTab == 'upcoming' }"
            >
                <Link
                    href="/tournament/upcoming"
                    data-toggle="tab"
                    preserve-state
                    ><span class="hidden-xs">upcoming events</span
                    ><span class="visible-xs">upcoming</span>
                </Link>
            </li>
        </ul>
        <div class="tab-content">
            <div class="block-content" v-show="currentTab == 'live'">
                <div class="article-box" v-if="live.data?.length">
                    <TournamentItem
                        v-for="main in live.data"
                        :key="main.id"
                        :tournament="main"
                    />
                </div>
                <div v-else>
                    <h4>Coming soon...</h4>
                </div>
            </div>
            <div class="block-content" v-show="currentTab == 'past'">
                <div class="article-box" v-if="past.data?.length">
                    <TournamentItem
                        v-for="main in past.data"
                        :key="main.id"
                        :tournament="main"
                    />
                </div>
                <div v-else>
                    <h4>No past event...</h4>
                </div>
            </div>
            <div class="block-content" v-show="currentTab == 'upcoming'">
                <div class="article-box" v-if="upcoming.data?.length">
                    <TournamentItem
                        v-for="main in upcoming.data"
                        :key="main.id"
                        :tournament="main"
                    />
                </div>
                <div v-else>
                    <h4>No upcoming event...</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-top">
        <button @click="scrollToTop" class="btn btn-danger scroll-top-btn">
            <i class="fa-sharp fa-solid fa-chevron-up"></i>
        </button>
    </div>
</template>

<script setup>
import { onMounted, onBeforeUnmount, ref, watch } from "@vue/runtime-core";
import defaultImg from "/public/default-img.png";
import { Head, Link } from "@inertiajs/inertia-vue3";
import moment from "moment";

import TournamentItem from "./TournamentItem.vue";

const props = defineProps({
    live: Object,
    past: Object,
    upcoming: Object,
    currentTab: {
        type: String,
        default: "live",
    },
});

const tab = ref(0);

const changeTab = (currentTab) => {
    tab.value = currentTab;
};

// const liveEventCollection = ref([]);
// const pastEventCollection = ref([]);
// const upcomingEventCollection = ref([]);

function stickyScroll() {
    const tabs = document.querySelector(".custom-tabs");
    const nav = document.querySelector(".nav-list-container");
    const { top } = tabs.getBoundingClientRect();
    const scrollTopBtn = document.querySelector(".scroll-top");

    if (top <= nav.offsetHeight) {
        tabs.style.top = `${nav.offsetHeight}px`;
        tabs.style.border = "none";
        tabs.style.backgroundColor = "white";
        tabs.style.boxShadow = "0px 8px 40px rgba(0, 0, 0, 0.20)";
        scrollTopBtn.style.display = "block";
        return;
    }
    tabs.style.top = "0px";
    tabs.style.backgroundColor = "none";
    tabs.style.boxShadow = "none";
    scrollTopBtn.style.display = "none";
    tabs.style.borderBottom = "2px solid #f44336";
}

function scrollToTop() {
    window.scroll({ top: 0, behavior: "smooth" });
}

onMounted(() => {
    window.addEventListener("scroll", stickyScroll);
});
onBeforeUnmount(() => {
    window.removeEventListener("scroll", stickyScroll);
});

// watch(
//     () => props.tournamentList.data,
//     (first) => {
//         upcomingEventCollection.value = first.filter(
//             ({ status }) => status === "upcoming"
//         );
//         pastEventCollection.value = first.filter(
//             ({ status }) => status === "past"
//         );
//         liveEventCollection.value = first.filter(
//             ({ status }) => status === "live"
//         );
//     }
// );
</script>

<style scoped>
.custom-tabs {
    position: sticky;
    position: -webkit-sticky;
    top: 0;
    z-index: 999;
    transition: all 0.5s ease;
}

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
</style>
