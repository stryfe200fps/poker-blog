<template>
    <Head>
        <title>Live Reporting</title>
    </Head>
    <div class="about-more-autor">
        <TabList :currentTab="currentTab" :event="event" :dayValue="dayValue" />
        <div class="tab-content">
            <div v-show="currentTab == null">
                <div v-if="isLoading">
                    <LoadingBar />
                </div>
                <div v-else>
                    <div
                        class="advertisement"
                        v-if="reportingBanner"
                        :style="{
                            cursor: reportingBanner.url ? 'pointer' : 'auto',
                        }"
                        @click="visitBanner(reportingBanner.url)"
                    >
                        <BannerCard :banner="reportingBanner" />
                    </div>
                    <LiveUpdates
                        v-for="(report, index) in reports"
                        :key="index"
                        :report="report"
                        :event="event"
                        :url="url"
                    />
                    <div
                        v-if="reports?.length"
                        v-observe-visibility="handleScrolledToBottom"
                    ></div>
                </div>
            </div>
            <div v-show="currentTab == 'chip-stack'">
                <div v-if="isLoading">
                    <LoadingBar />
                </div>
                <div v-else>
                    <ChipStack :chipCounts="chipCounts" />
                </div>
            </div>
            <div v-show="currentTab == 'whatsapp'">
                <div v-if="isLoading">
                    <LoadingBar />
                </div>
                <div v-else>
                    <div v-html="whatsappContent.content"></div>
                    <WhatsappTable :whatsapp="whatsapp" />
                </div>
            </div>
            <div v-show="currentTab == 'gallery'">
                <div v-if="isLoading">
                    <LoadingBar />
                </div>
                <div v-else>
                    <div class="grid-box">
                        <div v-if="gallery?.length">
                            <div id="my-gallery" class="grid-gallery">
                                <div
                                    v-for="(image, index) in gallery"
                                    :key="index"
                                >
                                    <a
                                        :href="image.og_image"
                                        :data-pswp-width="900"
                                        :data-pswp-height="640"
                                        target="_blank"
                                        rel="noreferrer"
                                    >
                                        <img
                                            :src="image.md_image"
                                            :alt="image.md_image"
                                            loading="lazy"
                                            class="img-responsive"
                                        />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <h4>There are no gallery at the moment.</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="currentTab == 'payouts'">
                <div v-if="isLoading">
                    <LoadingBar />
                </div>
                <div v-else>
                    <PayoutsTable
                        :payouts="payouts"
                        :currency="event.currency.prefix"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import {
    onMounted,
    onBeforeUnmount,
    onUpdated,
    computed,
    ref,
} from "@vue/runtime-core";
import PhotoSwipeLightbox from "photoswipe/lightbox";
import "photoswipe/style.css";

import LoadingBar from "@/Components/LoadingBar.vue";
import TabList from "./TabList.vue";
import BannerCard from "../BannerCard.vue";
import LiveUpdates from "./LiveUpdates.vue";
import ChipStack from "./ChipStack.vue";
import WhatsappTable from "./WhatsappTable.vue";
import PayoutsTable from "./PayoutsTable.vue";

const props = defineProps({
    event: {
        type: Object,
    },
    reports: {
        type: Object,
    },
    chipCounts: {
        type: Object,
    },
    whatsappContent: {
        type: Object,
    },
    whatsapp: {
        type: Object,
    },
    gallery: {
        type: Object,
    },
    payouts: {
        type: Object,
    },
    currentTab: {
        type: String,
        default: "report",
    },
    day: {
        type: String,
    },
    url: {
        type: String,
    },
    reportingBanner: {
        type: Object,
    },
    isLoading: {
        type: Boolean,
    },
    hasNewReport: {
        type: Boolean,
    },
});

const emit = defineEmits(["loadMore"]);

const tab = ref(0);
const id = ref(null);

const dayValue = computed(() => {
    if (props.day === props.currentTab) {
        let { available_day_with_reports } = props.event;
        if (available_day_with_reports) {
            let days = available_day_with_reports.map((day) => day.name);
            return days[days.length - 1]
                .replace(/[^A-Z0-9]+/gi, "-")
                .toLowerCase();
        }
    }
    return props.day.replace(/[^A-Z0-9]+/gi, "-").toLowerCase();
});

function handleScrolledToBottom(isVisible) {
    if (!isVisible) return;
    emit("loadMore");
}

function visitBanner(url) {
    if (url) window.open(url, "_blank");
}

function stickyScroll() {
    const tabs = document.querySelector(".custom-tabs");
    const mobileHeader = document.querySelector(".mobile-header");
    const nav = document.querySelector(".nav-list-container");
    const { top } = tabs.getBoundingClientRect();
    const width = document.body.clientWidth;

    if (top <= mobileHeader.offsetHeight && width <= 767) {
        tabs.style.top = `${mobileHeader.offsetHeight}px`;
        tabs.style.border = "none";
        tabs.style.backgroundColor = "white";
        tabs.style.boxShadow = "0px 8px 40px rgba(0, 0, 0, 0.20)";
        return;
    }

    if (top <= nav.offsetHeight && width >= 768) {
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

    // adding scroll-padding-top
    document.documentElement.style.setProperty(
        "--scroll-padding",
        tabs.offsetHeight + 150 + "px"
    );
}

Inertia.on("success", () => {
    if (!props.hasNewReport) window.scrollTo({ top: 0 });
});

const lightbox = new PhotoSwipeLightbox({
    gallery: "#my-gallery",
    children: "a",
    pswpModule: () => import("photoswipe"),
});

onBeforeUnmount(() => {
    window.removeEventListener("scroll", stickyScroll);
    lightbox.destroy();
});

onMounted(() => {
    id.value = window.location.hash.substring(1);
    window.addEventListener("scroll", stickyScroll);
    if (!props.isLoading) lightbox.init();
});

onUpdated(() => {
    document.getElementById(id.value)?.scrollIntoView();
    if (!props.isLoading) lightbox.init();
});
</script>

<style scoped>
.grid-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(10rem, 1fr));
    gap: 10px;
}

:deep(.gallery-thumbnail a img) {
    margin-bottom: 10px;
}

.text-secondary {
    color: #2d3436;
}

.text-green {
    color: #2ecc71;
}

.text-red {
    color: #e74c3c;
}

.single-post-box .post-tags-box ul.tags-box li a {
    margin: 0px 10px 10px 0px;
}

.each-post {
    border-top: 1px solid #d3d3d3;
    border-bottom: 1px solid #d3d3d3;
}

.margin-bottom {
    margin-bottom: 20px;
}

.margin-top {
    margin-top: 20px;
}

ul.post-tags li .facebook {
    background-color: unset;
    margin-right: unset;
}

ul.post-tags li .twitter {
    background-color: unset;
}

.twitter i {
    margin-right: 1px;
}

.facebook i {
    margin-right: 1px;
}

.whatsapp {
    background-color: unset;

    margin-right: unset;
    margin-left: unset;
}

.single-post-box .post-tags-box {
    padding: unset;
}

@media (min-width: 768px) {
    .post-content-min-height {
        min-height: 200px;
    }
}

@media (min-width: 992px) {
    .post-content-min-height {
        min-height: 270px;
    }
}

@media (min-width: 1200px) {
    .post-content-min-height {
        min-height: 320px;
    }
}
</style>
