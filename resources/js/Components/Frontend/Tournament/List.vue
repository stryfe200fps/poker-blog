<template>
    <div class="about-more-autor">
        <ul class="nav nav-tabs custom-tabs">
            <li @click.prevent="changeTab(0)" :class="{ active: tab == 0 }">
                <a href="#" data-toggle="tab"
                    ><span class="hidden-xs">latest events</span
                    ><span class="visible-xs">latest</span></a
                >
            </li>
            <li @click.prevent="changeTab(1)" :class="{ active: tab == 1 }">
                <a href="#" data-toggle="tab"
                    ><span class="hidden-xs">past events</span
                    ><span class="visible-xs">past</span>
                </a>
            </li>
            <li @click.prevent="changeTab(2)" :class="{ active: tab == 2 }">
                <a href="#" data-toggle="tab"
                    ><span class="hidden-xs">upcoming events</span
                    ><span class="visible-xs">upcoming</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="block-content" v-show="tab == 0">
                <div class="article-box" v-if="liveEventCollection.length">
                    <TournamentList
                        v-for="main in liveEventCollection"
                        :key="main.id"
                        :tournament="main"
                    />
                </div>
                <div v-else>
                    <h4>No live event...</h4>
                </div>
            </div>
            <div class="block-content" v-show="tab == 1">
                <div class="article-box" v-if="pastEventCollection.length">
                    <TournamentList
                        v-for="main in pastEventCollection"
                        :key="main.id"
                        :tournament="main"
                    />
                </div>
                <div v-else>
                    <h4>No past event...</h4>
                </div>
            </div>
            <div class="block-content" v-show="tab == 2">
                <div class="article-box" v-if="upcomingEventCollection.length">
                    <TournamentList
                        v-for="main in upcomingEventCollection"
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

import TournamentList from "./TournamentItem.vue";

const props = defineProps({
    tournamentList: Object,
});

const tab = ref(0);

const changeTab = (currentTab) => {
    tab.value = currentTab;
};

const liveEventCollection = ref([]);
const pastEventCollection = ref([]);
const upcomingEventCollection = ref([]);

function stickyScroll() {
    const tabs = document.querySelector(".custom-tabs");
    const { top } = tabs.getBoundingClientRect();
    const scrollTopBtn = document.querySelector(".scroll-top");

    if (top <= 0) {
        tabs.style.border = "none";
        tabs.style.backgroundColor = "white";
        tabs.style.boxShadow = "0px 8px 40px rgba(0, 0, 0, 0.20)";
        scrollTopBtn.style.display = "block";
        return;
    }
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

watch(
    () => props.tournamentList.data,
    (first) => {
        upcomingEventCollection.value = first.filter(
            ({ status }) => status === "upcoming"
        );
        pastEventCollection.value = first.filter(
            ({ status }) => status === "past"
        );
        liveEventCollection.value = first.filter(
            ({ status }) => status === "live"
        );
    }
);
</script>

<style scoped>
.custom-tabs {
    position: sticky;
    position: -webkit-sticky;
    top: 0;
    z-index: 999;
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
</style>
