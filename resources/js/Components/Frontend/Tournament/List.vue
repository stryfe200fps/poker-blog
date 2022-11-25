<template>
    <div class="about-more-autor">
        <ul class="nav nav-tabs custom-tabs">
            <li
                @click.prevent="changeTab(currentTab)"
                :class="{ active: currentTab === 'live' }"
            >
                <Link href="/live-reporting" data-toggle="tab" preserve-state
                    ><span class="hidden-xs">live & upcoming events</span
                    ><span class="visible-xs">live & upcoming</span></Link
                >
            </li>
            <li
                @click.prevent="changeTab(currentTab)"
                :class="{ active: currentTab === 'past' }"
            >
                <Link
                    href="/live-reporting/past"
                    data-toggle="tab"
                    preserve-state
                    ><span class="hidden-xs">past events</span
                    ><span class="visible-xs">past</span>
                </Link>
            </li>
        </ul>
        <div class="tab-content">
            <div class="block-content" v-show="currentTab === 'live'">
                <div v-if="isLoading">
                    <LoadingBar />
                </div>
                <div v-else>
                    <div class="article-box" v-if="live?.length">
                        <TournamentItem
                            v-for="main in live"
                            :key="main.id"
                            :tournament="main"
                        />
                    </div>
                    <div
                        v-if="live?.length"
                        v-observe-visibility="handleScrolledToBottom"
                    ></div>
                    <div v-else>
                        <h4>
                            There are no live or upcoming events at the moment.
                        </h4>
                    </div>
                </div>
            </div>
            <div class="block-content" v-show="currentTab === 'past'">
                <div v-if="isLoading">
                    <LoadingBar />
                </div>
                <div v-else>
                    <div class="article-box" v-if="past?.length">
                        <TournamentItem
                            v-for="main in past"
                            :key="main.id"
                            :tournament="main"
                        />
                    </div>
                    <div
                        v-if="past?.length"
                        v-observe-visibility="handleScrolledToBottom"
                    ></div>
                    <div v-else>
                        <h4>There are no past events at the moment.</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, onBeforeUnmount, ref } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
<<<<<<< HEAD
import { Inertia } from "@inertiajs/inertia";
=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32

import TournamentItem from "./TournamentItem.vue";
import LoadingBar from "@/Components/LoadingBar.vue";

const props = defineProps({
    live: Object,
    past: Object,
    currentTab: {
        type: String,
        default: "live",
    },
    isLoading: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(["loadMore"]);
const tab = ref("");

function changeTab(currentTab) {
    tab.value = currentTab;
}

function handleScrolledToBottom(isVisible) {
    if (!isVisible) return;
    emit("loadMore");
}

function stickyScroll() {
    const tabs = document.querySelector(".custom-tabs");
<<<<<<< HEAD
    const mobileHeader = document.querySelector(".mobile-header");
=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    const nav = document.querySelector(".nav-list-container");
    const { top } = tabs.getBoundingClientRect();
    const width = document.body.clientWidth;

<<<<<<< HEAD
    if (top <= mobileHeader.offsetHeight && width <= 767) {
        tabs.style.top = `${mobileHeader.offsetHeight}px`;
        tabs.style.border = "none";
        tabs.style.backgroundColor = "white";
        tabs.style.boxShadow = "0px 8px 40px rgba(0, 0, 0, 0.20)";
        return;
    }

    if (top <= nav.offsetHeight && width >= 768) {
=======
    if (top <= nav.offsetHeight) {
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        tabs.style.top = width === 768 ? "0px" : `${nav.offsetHeight}px`;
        tabs.style.border = "none";
        tabs.style.backgroundColor = "white";
        tabs.style.boxShadow = "0px 8px 40px rgba(0, 0, 0, 0.20)";
        return;
    }
    tabs.style.top = "0px";
    tabs.style.backgroundColor = "none";
    tabs.style.boxShadow = "none";
    tabs.style.borderBottom = "2px solid #f44336";
}

onMounted(() => {
    window.addEventListener("scroll", stickyScroll);
});

onBeforeUnmount(() => {
    window.removeEventListener("scroll", stickyScroll);
});
</script>

<style scoped>
.custom-tabs {
    position: sticky;
    position: -webkit-sticky;
    top: 0;
    z-index: 999;
    transition: all 0.5s ease;
}
</style>
