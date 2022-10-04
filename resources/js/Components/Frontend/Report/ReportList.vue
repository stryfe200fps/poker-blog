<template>
    <div class="about-more-autor">
        <ul class="nav nav-tabs custom-tabs">
            <li @click.prevent="changeTab(0)" :class="{ active: tab == 0 }">
                <a href="#" data-toggle="tab">
                    <span class="hide-on-mobile">LIVE UPDATES</span>
                    <span class="show-on-mobile">UPDATES</span>
                </a>
            </li>
            <li @click.prevent="changeTab(1)" :class="{ active: tab == 1 }">
                <a href="#" data-toggle="tab">
                    <span class="hide-on-mobile">CHIP COUNTS</span>
                    <span class="show-on-mobile">CHIPS</span>
                </a>
            </li>
            <li @click.prevent="changeTab(2)" :class="{ active: tab == 2 }">
                <a href="#" data-toggle="tab">GALLERY</a>
            </li>
            <li @click.prevent="changeTab(3)" :class="{ active: tab == 3 }">
                <a href="#" data-toggle="tab">PAYOUT</a>
            </li>
            <li @click.prevent="changeTab(4)" :class="{ active: tab == 4 }">
                <a href="#" data-toggle="tab">#WHATSAPP</a>
            </li>
        </ul>
        <div class="tab-content">
            <div v-show="tab == 0 && reports.length" id="liveReport">
                <div
                    v-for="(report, index) in reports"
                    :key="index"
                    class="single-post-box round"
                >
                    <EachReport
                        v-for="(item, index) in report.collection"
                        :key="index"
                        :item="item"
                    />

                    <div
                        class="day-divider"
                        style="
                            border-bottom: 1px solid #d3d3d3;
                            margin-top: 20px;
                        "
                    >
                        <span>{{ report.level }}</span
                        ><br />
                    </div>
                </div>
            </div>
            <div v-show="tab == 1">
                <div class="margin-top">
                    <CustomeTable v-if="event?.chip_stacks?.length">
                        <template v-slot:table-head>
                            <tr class="text-primary">
                                <th class="text-center">Rank</th>
                                <th>Player</th>
                                <th class="text-center hide-on-tablet">
                                    Country
                                </th>
                                <th class="text-right">Chips</th>
                                <th class="text-right hide-on-mobile">
                                    Progress
                                </th>
                            </tr>
                        </template>
                        <template v-slot:table-body>
                            <tr
                                v-for="(stack, index) in event.chip_stacks"
                                :key="stack?.player?.id"
                            >
                                <td class="text-center">{{ index + 1 }}</td>
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
                                    <span style="white-space: nowrap">{{
                                        stack?.player?.name
                                    }}</span>
                                </td>
                                <td
                                    class="text-center hide-on-tablet"
                                    v-if="stack?.player?.country"
                                >
                                    <CountryFlag
                                        :title="stack?.player?.country?.name"
                                        :iso="
                                            stack?.player?.country?.iso_3166_2
                                        "
                                    />
                                </td>
                                <td class="text-center hide-on-tablet" v-else>
                                    ?
                                </td>
                                <td
                                    v-if="stack.report_id == null"
                                    class="text-right"
                                >
                                    {{ stack.current_chips.toLocaleString() }}
                                </td>
                                <td v-else class="text-right">
                                    {{
                                        stack.current_chips === 0
                                            ? "BUSTED"
                                            : stack.current_chips.toLocaleString()
                                    }}
                                </td>
                                <td
                                    v-if="stack.report_id == null"
                                    class="text-right"
                                >
                                    <i class="fa fa-whatsapp"> </i> whatsapp
                                </td>
                                <td v-else class="text-right hide-on-mobile">
                                    {{
                                        stack.current_chips === 0
                                            ? ""
                                            : stack.changes.toLocaleString()
                                    }}
                                    <span
                                        v-if="stack.symbol === 'up'"
                                        style="margin-left: 10px"
                                        ><i
                                            v-if="stack.current_chips != 0"
                                            class="fa-sharp fa-solid fa-caret-up text-green"
                                        ></i
                                    ></span>
                                    <span v-else style="margin-left: 10px"
                                        ><i
                                            v-if="stack.current_chips != 0"
                                            class="fa-sharp fa-solid fa-caret-down text-red"
                                        ></i
                                    ></span>
                                </td>
                            </tr>
                        </template>
                    </CustomeTable>
                </div>
            </div>
            <div v-show="tab == 2">
                <div class="grid-box">
                    <div id="my-gallery" class="row">
                        <div class="col-xs-12">
                            <a
                                v-for="(image, index) in event.gallery"
                                :key="index"
                                :href="image.main"
                                :data-pswp-width="900"
                                :data-pswp-height="640"
                                target="_blank"
                                rel="noreferrer"
                            >
                                <img
                                    style="
                                        width: 120px;
                                        max-width: 100%;
                                        height: auto;
                                        object-fit: cover;
                                        margin-right: 10px;
                                        margin-bottom: 10px;
                                    "
                                    :src="image.thumbnail"
                                    :alt="image.thumbnail"
                                />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="tab == 3">
                <div class="margin-top">
                    <CustomeTable v-if="event?.payouts?.length">
                        <template v-slot:table-head>
                            <tr class="text-primary">
                                <th class="text-center">Place</th>
                                <th>Name</th>
                                <th class="text-center hide-on-mobile">
                                    Country
                                </th>
                                <th class="text-right">
                                    Prize (<span v-html="event.currency.prefix">
                                    </span
                                    >)
                                </th>
                            </tr>
                        </template>
                        <template v-slot:table-body>
                            <tr
                                v-for="payout in event.payouts"
                                :key="payout.player"
                            >
                                <div v-if="payout.player"></div>
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
                                                    ?.full_name
                                            "
                                            :iso="
                                                payout.player?.country
                                                    ?.iso_3166_2
                                            "
                                    /></span>
                                    <span v-else>N/A</span>
                                </td>
                                <td class="text-right">
                                    <span v-html="event.currency.prefix">
                                    </span>
                                    {{ Number(payout.prize).toLocaleString() }}
                                </td>
                            </tr>
                        </template>
                    </CustomeTable>
                </div>
            </div>
            <div v-show="tab == 4">
                <div class="margin-top">
                    {{ event.whatsapp }}
                    <p>Whatsapp</p>
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
import { ref, computed } from "@vue/reactivity";
import { onMounted, onBeforeUnmount, watch } from "@vue/runtime-core";
import CustomeTable from "../CustomeTable.vue";
import CountryFlag from "vue3-country-flag-icon";
import VuePictureSwipe from "vue3-picture-swipe";
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

// components
import EachReport from "./EachReport.vue";

const props = defineProps({
    reports: {
        type: Object,
    },
    event: {
        type: Object,
    },
});

const tab = ref(0);

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

onMounted(async () => {
    window.addEventListener("scroll", stickyScroll);
    lightbox.init();
});
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
