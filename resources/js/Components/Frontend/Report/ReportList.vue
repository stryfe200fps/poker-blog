<template>
    <div class="about-more-autor">
        <ul class="nav nav-tabs custom-tabs">
            <li
                @click.prevent="changeTab(currentTab)"
                :class="{ active: currentTab == 'reports' }"
            >
                <Link
                    :href="'/event/' + event.slug"
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
                    :href="'/event/' + event.slug + '/chip-stack'"
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
                    :href="'/event/' + event.slug + '/whatsapp'"
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
                    :href="'/event/' + event.slug + '/gallery'"
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
                    :href="'/event/' + event.slug + '/payouts'"
                    data-toggle="tab"
                    preserve-state
                    >PAYOUTS</Link
                >
            </li>
        </ul>
        <div class="tab-content">
            <div
                v-show="currentTab == 'reports' && reports.length"
                id="liveReport"
            >
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
                <div
                    v-if="reports.length"
                    v-observe-visibility="handleScrolledToBottom"
                ></div>
            </div>
            <div v-show="currentTab == 'chip-stack'">
                <div class="margin-top">
                    <CustomeTable v-if="chipCounts.length">
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
                                v-for="(stack, index) in chipCounts"
                                :key="index"
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
                                    <span style="white-space: nowrap"
                                        >{{ stack?.player?.name }}
                                        <span v-if="stack.player?.pseudonym"
                                            >({{
                                                stack.player?.pseudonym
                                            }})</span
                                        ></span
                                    >
                                </td>
                                <td
                                    class="text-center hide-on-tablet"
                                    v-if="stack?.player?.country"
                                >
                                    {{ stack?.player?.country }}

                                    <CountryFlag
                                        :title="stack?.player?.country"
                                        :iso="stack?.player?.flag"
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
            <div v-show="currentTab == 'gallery'">
                <div class="grid-box">
                    <div id="my-gallery" class="row">
                        <div class="col-xs-12">
                            <a
                                v-for="(image, index) in gallery"
                                :key="index"
                                :href="image.main"
                                :data-pswp-width="900"
                                :data-pswp-height="640"
                                target="_blank"
                                rel="noreferrer"
                            >
                                <img
                                    style="
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
            <div v-show="currentTab == 'payouts'">
                <div class="margin-top">
                    <CustomeTable v-if="payouts?.length">
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
                            <tr v-for="(payout, index) in payouts" :key="index">
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
                                            :title="payout.player?.country"
                                            :iso="payout.player?.flag"
                                        />
                                    </span>
                                    <span v-else>?</span>
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
            <div v-show="currentTab == 'whatsapp'">
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
    <div class="toast" :class="{ active: isActive }" @click="scrollToTop">
        <div class="toast-content">
            <i class="fas fa-info-circle info"></i>

            <div class="message">
                <span class="text text-1">New post - click here</span>
            </div>
        </div>
        <div class="progress" :class="{ active: isActive }"></div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import { onMounted, onBeforeUnmount, onUpdated } from "@vue/runtime-core";
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
import AlertMessage from "@/photo_templates/AlertMessage.vue";

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
});
const emit = defineEmits(["loadMore", "showNewReport"]);

function handleScrolledToBottom(isVisible) {
    if (!isVisible) return;
    emit("loadMore");
}

const tab = ref(0);
const id = ref(null);
const isActive = ref(false);

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

    // adding scroll-padding-top
    document.documentElement.style.setProperty(
        "--scroll-padding",
        tabs.offsetHeight + 150 + "px"
    );
}

function scrollToTop() {
    window.scroll({ top: 0, behavior: "smooth" });
    isActive.value = false;
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

onMounted(() => {
    id.value = window.location.hash.substring(1);
    window.addEventListener("scroll", stickyScroll);
    lightbox.init();

    window.Echo.channel("report").listen("NewReport", (e) => {
        emit("showNewReport");
        isActive.value = true;

        setTimeout(() => {
            isActive.value = false;
        }, 5000);
    });
});

onUpdated(() => {
    document.getElementById(id.value)?.scrollIntoView();
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

.toast {
    position: fixed;
    top: 25px;
    right: 30px;
    z-index: 1000;
    overflow: hidden;
    padding: 20px 35px 20px 25px;
    background-color: #fff;
    border-radius: 12px;
    cursor: pointer;
    box-shadow: 0 6px 20px -5px rgba(0, 0, 0, 0.5);
    transform: translateX(calc(100% + 30px));
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
}

.toast.active {
    transform: translateX(0%);
}

.toast .toast-content {
    display: flex;
    align-items: center;
}

.toast-content .info {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
}

.toast-content .message {
    display: flex;
    flex-direction: column;
    margin: 0 20px;
}

.message .text {
    font-size: 16px;
    font-weight: 400;
    color: #666666;
}

.message .text.text-1 {
    font-weight: 600;
    color: #333;
}

.toast .progress {
    position: absolute;
    bottom: -20px;
    left: 0;
    width: 100%;
    height: 3px;
}

.toast .progress:before {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background-color: #f44336;
}

.progress.active:before {
    animation: progress 5s linear forwards;
}

@keyframes progress {
    100% {
        right: 100%;
    }
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
