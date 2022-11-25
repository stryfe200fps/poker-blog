<template>
    <Head>
        <title>Live Reporting</title>
    </Head>
    <div class="about-more-autor">
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
        <div class="tab-content">
            <div v-show="currentTab == null" id="liveReport">
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
                        <div class="desktop-advert">
                            <img
                                :src="reportingBanner.image_set?.og_image"
                                :alt="reportingBanner.image_set?.og_image"
                                style="max-width: 100%; height: auto"
                            />
                        </div>
                        <div class="tablet-advert">
                            <img
                                :src="reportingBanner.image_set?.og_image"
                                :alt="reportingBanner.image_set?.og_image"
                                style="max-width: 100%; height: auto"
                            />
                        </div>
                        <div class="mobile-advert">
                            <img
                                :src="reportingBanner.image_set?.og_image"
                                :alt="reportingBanner.image_set?.og_image"
                                style="max-width: 100%; height: auto"
                            />
                        </div>
                    </div>
                    <div
                        v-for="(report, index) in reports"
                        :key="index"
                        class="single-post-box round"
                    >
                        <EachReport
                            v-for="(item, index) in report.collection"
                            :key="index"
                            :item="item"
                            :event="event"
                            :id="index"
                            :url="url"
                        />
                        <div
                            class="day-divider"
                            style="
                                border-bottom: 1px solid #d3d3d3;
                                margin-top: 20px;
                                margin-bottom: 25px;
                            "
                        >
                            <span>{{ report.level }}</span
                            ><br />
                        </div>
                    </div>
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
                    <div class="margin-top">
                        <div v-if="chipCounts.length">
                            <CustomeTable>
                                <template v-slot:table-head>
                                    <tr class="text-primary">
                                        <th class="text-center">Rank</th>
                                        <th>Player</th>
                                        <th class="text-center hide-on-tablet">
                                            Country
                                        </th>
                                        <th></th>
                                        <th class="text-right">Chips</th>
                                        <th class="text-right hide-on-mobile">
                                            Progress
                                        </th>
                                    </tr>
                                </template>
                                <template v-slot:table-body>
                                    <tr
                                        v-for="(stack, index) in chipCounts"
                                        :key="index"
                                    >
                                        <td class="text-center">
                                            {{ index + 1 }}
                                        </td>
                                        <td>
                                            <img
                                                class="hide-on-tablet"
                                                v-if="stack?.player?.avatar"
                                                :src="stack?.player?.avatar"
                                            />
                                            <img
                                                class="hide-on-tablet"
                                                v-else
                                                :src="defaultAvatar"
                                            />
                                            <span
                                                style="white-space: nowrap"
                                                v-if="stack.player"
                                                >{{ stack?.player?.name }}
                                                <span
                                                    class="hide-on-tablet"
                                                    v-if="
                                                        stack.player?.pseudonym
                                                    "
                                                    >({{
                                                        stack.player?.pseudonym
                                                    }})</span
                                                ></span
                                            >
                                            <span
                                                style="white-space: nowrap"
                                                v-else
                                                >-</span
                                            >
                                        </td>
                                        <td
                                            class="text-center hide-on-tablet"
                                            v-if="stack?.player?.country"
                                        >
                                            <CountryFlag
                                                :title="stack?.player?.country"
                                                :iso="stack?.player?.flag"
                                            />
                                        </td>
                                        <td
                                            class="text-center hide-on-tablet"
                                            v-else
                                        >
                                            -
                                        </td>
                                        <td v-if="stack.player?.badge">
                                            <img
                                                :src="stack.player?.badge"
                                                :alt="stack.player?.badge"
                                            />
                                        </td>
                                        <td v-else></td>
                                        <td
                                            v-if="stack.report_id"
                                            class="text-right"
                                        >
                                            {{
                                                stack.current_chips.toLocaleString()
                                            }}
                                        </td>
                                        <td v-else class="text-right">
                                            {{
                                                stack.current_chips === 0
                                                    ? "BUSTED"
                                                    : stack.current_chips.toLocaleString()
                                            }}
                                        </td>
                                        <!-- <td
                                    v-if="stack.report_id == null"
                                    class="text-right"
                                >
                                    <i class="fa fa-whatsapp"> </i> whatsapp
                                </td> -->
                                        <td class="text-right hide-on-mobile">
                                            {{
                                                stack.current_chips === 0
                                                    ? ""
                                                    : stack.changes.toLocaleString()
                                            }}
                                            <span
                                                v-if="stack.symbol === 'up'"
                                                style="margin-left: 10px"
                                                ><i
                                                    v-if="
                                                        stack.current_chips != 0
                                                    "
                                                    class="fa-sharp fa-solid fa-caret-up text-green"
                                                ></i
                                            ></span>
                                            <span
                                                v-else
                                                style="margin-left: 10px"
                                                ><i
                                                    v-if="
                                                        stack.current_chips != 0
                                                    "
                                                    class="fa-sharp fa-solid fa-caret-down text-red"
                                                ></i
                                            ></span>
                                        </td>
                                    </tr>
                                </template>
                            </CustomeTable>
                        </div>
                        <div v-else>
                            <h4>There are no chip counts at the moment.</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="currentTab == 'whatsapp'">
                <div v-if="isLoading">
                    <LoadingBar />
                </div>
                <div v-else>
                    <div v-html="whatsappContent.content"></div>
                    <div class="margin-top">
                        <div v-if="whatsapp?.length">
                            <CustomeTable>
                                <template v-slot:table-head>
                                    <tr class="text-primary">
                                        <th class="text-left">Date Posted</th>
                                        <th>Player</th>
                                        <th class="text-center hide-on-tablet">
                                            Country
                                        </th>
                                        <th></th>
                                        <th class="text-right">Chips</th>
                                        <th class="text-right hide-on-mobile">
                                            Progress
                                        </th>
                                    </tr>
                                </template>
                                <template v-slot:table-body>
                                    <tr
                                        v-for="(stack, index) in whatsapp"
                                        :key="index"
                                    >
                                        <td class="text-left">
                                            {{ stack.date }}
                                        </td>
                                        <td>
                                            <img
                                                class="hide-on-tablet"
                                                v-if="stack?.player?.avatar"
                                                :src="stack?.player?.avatar"
                                            />
                                            <img
                                                class="hide-on-tablet"
                                                v-else
                                                :src="defaultAvatar"
                                            />
                                            <span
                                                style="white-space: nowrap"
                                                v-if="stack.player"
                                                >{{ stack?.player?.name }}
                                                <span
                                                    class="hide-on-tablet"
                                                    v-if="
                                                        stack.player?.pseudonym
                                                    "
                                                    >({{
                                                        stack.player?.pseudonym
                                                    }})</span
                                                ></span
                                            >
                                            <span
                                                v-else
                                                style="white-space: nowrap"
                                                >-</span
                                            >
                                        </td>
                                        <td
                                            class="text-center hide-on-tablet"
                                            v-if="stack?.player?.country"
                                        >
                                            <CountryFlag
                                                :title="stack?.player?.country"
                                                :iso="stack?.player?.flag"
                                            />
                                        </td>
                                        <td
                                            class="text-center hide-on-tablet"
                                            v-else
                                        >
                                            -
                                        </td>
                                        <td v-if="stack.player?.badge">
                                            <img
                                                :src="stack.player?.badge"
                                                :alt="stack.player?.badge"
                                            />
                                        </td>
                                        <td v-else></td>
                                        <td
                                            v-if="stack.report_id"
                                            class="text-right"
                                        >
                                            {{
                                                stack.current_chips.toLocaleString()
                                            }}
                                        </td>
                                        <td v-else class="text-right">
                                            {{
                                                stack.current_chips === 0
                                                    ? "BUSTED"
                                                    : stack.current_chips.toLocaleString()
                                            }}
                                        </td>
                                        <!-- <td
                                    v-if="stack.report_id == null"
                                    class="text-right"
                                >
                                    <i class="fa fa-whatsapp"> </i> whatsapp
                                </td> -->
                                        <td class="text-right hide-on-mobile">
                                            {{
                                                stack.current_chips === 0
                                                    ? ""
                                                    : stack.changes.toLocaleString()
                                            }}
                                            <span
                                                v-if="stack.symbol === 'up'"
                                                style="margin-left: 10px"
                                                ><i
                                                    v-if="
                                                        stack.current_chips != 0
                                                    "
                                                    class="fa-sharp fa-solid fa-caret-up text-green"
                                                ></i
                                            ></span>
                                            <span
                                                v-else
                                                style="margin-left: 10px"
                                                ><i
                                                    v-if="
                                                        stack.current_chips != 0
                                                    "
                                                    class="fa-sharp fa-solid fa-caret-down text-red"
                                                ></i
                                            ></span>
                                        </td>
                                    </tr>
                                </template>
                            </CustomeTable>
                        </div>
                        <div v-else>
                            <h4>There are no whatsapp at the moment.</h4>
                        </div>
                    </div>
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
                    <div class="margin-top">
                        <div v-if="payouts?.length">
                            <CustomeTable>
                                <template v-slot:table-head>
                                    <tr class="text-primary">
                                        <th class="text-center">Place</th>
                                        <th>Name</th>
                                        <th class="text-center hide-on-mobile">
                                            Country
                                        </th>
                                        <th class="text-right">
                                            Prize (<span
                                                v-html="event.currency.prefix"
                                            >
                                            </span
                                            >)
                                        </th>
                                    </tr>
                                </template>
                                <template v-slot:table-body>
                                    <tr
                                        v-for="(payout, index) in payouts"
                                        :key="index"
                                    >
                                        <td class="text-center">
                                            {{ payout.position }}
                                        </td>
                                        <td>
                                            <span
                                                v-if="payout.player?.name"
                                                style="white-space: nowrap"
                                                >{{ payout.player?.name }}
                                            </span>
                                            <span v-else>N/A</span>
                                        </td>
                                        <td class="text-center hide-on-mobile">
                                            <span v-if="payout.player?.country">
                                                <CountryFlag
                                                    :title="
                                                        payout.player?.country
                                                    "
                                                    :iso="payout.player?.flag"
                                                />
                                            </span>
                                            <span v-else>-</span>
                                        </td>
                                        <td class="text-right">
                                            <span
                                                v-html="event.currency.prefix"
                                            >
                                            </span>
                                            {{
                                                Number(
                                                    payout.prize
                                                ).toLocaleString()
                                            }}
                                        </td>
                                    </tr>
                                </template>
                            </CustomeTable>
                        </div>
                        <div v-else>
                            <h4>There are no payouts at the moment.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import {
    onMounted,
    onBeforeUnmount,
    onUpdated,
    computed,
} from "@vue/runtime-core";
import LoadingBar from "@/Components/LoadingBar.vue";
import CustomeTable from "../CustomeTable.vue";
import CountryFlag from "vue3-country-flag-icon";
import defaultAvatar from "@/default-avatar.png";
import PhotoSwipeLightbox from "photoswipe/lightbox";
import "photoswipe/style.css";

import brokenMirror from "@/photo_templates/brokenmirror.png";
import bulletHole from "@/photo_templates/bullethole.png";
import flames from "@/photo_templates/flames.png";
import happyBirthday from "@/photo_templates/happybirthday.png";
import iceCubes from "@/photo_templates/icecubes.png";
import pocketAces from "@/photo_templates/pocketaces.png";
import sunRays from "@/photo_templates/sunrays.png";
import waterLeaves from "@/photo_templates/water-leaves.png";
import waterWaves from "@/photo_templates/water-waves.png";
import { createToast } from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";

// components
import EachReport from "./EachReport.vue";

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

const tab = ref(0);
const id = ref(null);

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

const changeTab = (currentTab) => {
    tab.value = currentTab;
};

const lightbox = new PhotoSwipeLightbox({
    gallery: "#my-gallery",
    children: "a",
    pswpModule: () => import("photoswipe"),
});

/* FRAMES */
function getFrame(theme) {
    switch (theme) {
        case "brokenMirror":
            return brokenMirror;
        case "bulletHole":
            return bulletHole;
        case "flames":
            return flames;
        case "happyBirthday":
            return happyBirthday;
        case "iceCubes":
            return iceCubes;
        case "pocketAces":
            return pocketAces;
        case "sunRays":
            return sunRays;
        case "waterLeaves":
            return waterLeaves;
        case "waterWaves":
            return waterWaves;
    }
}

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
.custom-tabs {
    position: sticky;
    position: -webkit-sticky;
    top: 0;
    z-index: 999;
    transition: all 0.5s ease;
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

.single-post-box .about-more-autor ul.nav-tabs {
    margin-bottom: 20px;
}

.single-post-box .post-tags-box ul.tags-box li a {
    margin: 0px 10px 10px 0px;
}

.imageFrame {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
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

@media (min-width: 769px) {
    .show-on-mobile {
        display: none;
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