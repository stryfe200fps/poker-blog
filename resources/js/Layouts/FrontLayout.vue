<template>
    <div class="active">
        <Header />
        <main>
            <section class="block-wrapper">
                <FullBanner
                    :formattedHomeBanner="formattedHomeBanner"
                    :formattedReportingBanner="formattedReportingBanner"
                    :formattedLiveReportingBanner="formattedLiveReportingBanner"
                    :formattedEventCalendarBanner="formattedEventCalendarBanner"
                    :formattedPokerRoomBanner="formattedPokerRoomBanner"
                    :formattedPokerTourBanner="formattedPokerTourBanner"
                    :url="url"
                    :currentComponent="currentComponent"
                />
                <div
                    class="container"
                    style="position: relative; background-color: #fff"
                >
                    <div class="row">
                        <div class="col-md-9 col-sm-8">
                            <slot />
                        </div>
                        <div class="col-md-3 col-sm-4" style="overflow: none">
                            <SideBar
                                :homeSideBanner="homeSideBanner"
                                :reportingSideBanner="reportingSideBanner"
                                :liveReportingSideBanner="
                                    liveReportingSideBanner
                                "
                                :eventCalendarSideBanner="
                                    eventCalendarSideBanner
                                "
                                :pokerRoomSideBanner="pokerRoomSideBanner"
                                :pokerTourSideBanner="pokerTourSideBanner"
                            />
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <Footer />
    </div>
    <CookieBanner />
    <ScrollTopButton />
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/inertia-vue3";
import { onMounted, onBeforeUnmount, ref, computed } from "@vue/runtime-core";
import { useBannerStore } from "@/Stores/banner.js";
import Echo from "laravel-echo";

import FullBanner from "../Components/Frontend/FullBanner.vue";
import Header from "../Components/Frontend/Header.vue";
import SideBar from "../Components/Frontend/MainContent/SideBar.vue";
import Footer from "../Components/Frontend/Footer.vue";
import CookieBanner from "../Components/Frontend/CookieBanner.vue";
import ScrollTopButton from "../Components/Frontend/ScrollTopButton.vue";

const bannerStore = useBannerStore();
const homeFullBanner = ref([]);
const homeSemiFullBanner = ref([]);
const homeSideBanner = ref([]);
const reportingFullBanner = ref([]);
const reportingSemiFullBanner = ref([]);
const reportingSideBanner = ref([]);
const liveReportingFullBanner = ref([]);
const liveReportingSemiFullBanner = ref([]);
const liveReportingSideBanner = ref([]);
const eventCalendarFullBanner = ref([]);
const eventCalendarSemiFullBanner = ref([]);
const eventCalendarSideBanner = ref([]);
const pokerRoomFullBanner = ref([]);
const pokerRoomSemiFullBanner = ref([]);
const pokerRoomSideBanner = ref([]);
const pokerTourFullBanner = ref([]);
const pokerTourSemiFullBanner = ref([]);
const pokerTourSideBanner = ref([]);

const url = computed(() => {
    return usePage().url.value;
});

const currentComponent = computed(() => {
    return usePage().component.value;
});

const formattedHomeBanner = computed(() => {
    const width = window.innerWidth;

    if (width >= 1920) {
        return homeFullBanner.value;
    } else {
        return homeSemiFullBanner.value;
    }
});

const formattedReportingBanner = computed(() => {
    const width = window.innerWidth;

    if (width >= 1920) {
        return reportingFullBanner.value;
    } else {
        return reportingSemiFullBanner.value;
    }
});

const formattedLiveReportingBanner = computed(() => {
    const width = window.innerWidth;

    if (width >= 1920) {
        return liveReportingFullBanner.value;
    } else {
        return liveReportingSemiFullBanner.value;
    }
});

const formattedEventCalendarBanner = computed(() => {
    const width = window.innerWidth;

    if (width >= 1920) {
        return eventCalendarFullBanner.value;
    } else {
        return eventCalendarSemiFullBanner.value;
    }
});

const formattedPokerRoomBanner = computed(() => {
    const width = window.innerWidth;

    if (width >= 1920) {
        return pokerRoomFullBanner.value;
    } else {
        return pokerRoomSemiFullBanner.value;
    }
});

const formattedPokerTourBanner = computed(() => {
    const width = window.innerWidth;

    if (width >= 1920) {
        return pokerTourFullBanner.value;
    } else {
        return pokerTourSemiFullBanner.value;
    }
});

function showScrollTopBtn() {
    const cookie = document.querySelector(".cookie.hide");
    const scrollTopBtn = document.querySelector(".scroll-top");

    if (window.scrollY > 200) {
        if (cookie) {
            scrollTopBtn.style.display = "block";
        }
        return;
    }
    scrollTopBtn.style.display = "none";
}

Inertia.on("success", (event) => {
    event.preventDefault();
    if (event.detail.page.component != "Event/Index") {
        window.scrollTo({ top: 0, behavior: "smooth" });
    }
});

onMounted(async () => {
    document.body.style.overflow = "auto";
    window.addEventListener("scroll", showScrollTopBtn);
    await bannerStore.getBanners();
    homeFullBanner.value = bannerStore.getHomeFullBanner();
    homeSemiFullBanner.value = bannerStore.getHomeSemiFullBanner();
    homeSideBanner.value = bannerStore.getHomeSideBanner();
    reportingFullBanner.value = bannerStore.getReportingFullBanner();
    reportingSemiFullBanner.value = bannerStore.getReportingSemiFullBanner();
    reportingSideBanner.value = bannerStore.getReportingSideBanner();
    liveReportingFullBanner.value = bannerStore.getLiveReportingFullBanner();
    liveReportingSemiFullBanner.value =
        bannerStore.getLiveReportingSemiFullBanner();
    liveReportingSideBanner.value = bannerStore.getLiveReportingSideBanner();
    eventCalendarFullBanner.value = bannerStore.getEventCalendarFullBanner();
    eventCalendarSemiFullBanner.value =
        bannerStore.getEventCalendarSemiFullBanner();
    eventCalendarSideBanner.value = bannerStore.getEventCalendarSideBanner();
    pokerRoomFullBanner.value = bannerStore.getPokerRoomFullBanner();
    pokerRoomSemiFullBanner.value = bannerStore.getPokerRoomSemiFullBanner();
    pokerRoomSideBanner.value = bannerStore.getPokerRoomSideBanner();
    pokerTourFullBanner.value = bannerStore.getPokerTourFullBanner();
    pokerTourSemiFullBanner.value = bannerStore.getPokerTourSemiFullBanner();
    pokerTourSideBanner.value = bannerStore.getPokerTourSideBanner();
});

onBeforeUnmount(() => {
    window.removeEventListener("scroll", showScrollTopBtn);
});
</script>

<style>
.reset-margin {
    margin: unset !important;
}

.whatsapp {
    background-color: #2ecc71;
}

div.block-content {
    margin: 30px 0 30px 0;
    padding: unset;
}

@media (max-width: 768px) {
    .hide-on-mobile {
        display: none;
    }
}

@media (max-width: 992px) {
    .hide-on-tablet {
        display: none;
    }
}

@media (max-width: 1200px) {
    .hide-on-desktop {
        display: none;
    }
}

@media (min-width: 1200px) {
    .hide-on-lg-desktop {
        display: none;
    }
}

.bold {
    font-weight: bold;
}

.text-sm {
    font-size: 12px;
}

.text-right {
    text-align: right;
}

.text-center {
    text-align: center;
}

.text-primary {
    color: #f44336 !important;
}

.text-green {
    color: #2ecc71;
}

.text-red {
    color: red;
}

.text-white {
    color: white;
}

.display-none {
    display: none;
}

.bg-primary {
    background-color: #2d3436 !important;
}

li {
    list-style: none;
}

.testimonial-img {
    background-position: center;
    background-size: cover;
    width: 150px;
    height: 150px;
    border-radius: 100%;
    margin: 0 auto;
}

.highlight-img {
    width: 100px;
    height: 87px;
}

.play-btn {
    width: 40px;
    height: 40px;
    border-radius: 100%;
    background-color: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
}

.link-header {
    color: #f44336 !important;
}

#logo {
    width: 165px;
    height: 80px;
}

.padding-0 {
    padding: 0 !important;
}

.grid-box .news-post,
.grid-box ul.list-posts {
    margin-bottom: 0px;
}

.list-line-posts {
    background-color: transparent;
}

.image-post-slider .bx-wrapper .bx-prev,
.image-post-slider .bx-wrapper .bx-next {
    display: none;
}

.bx-wrapper .bx-viewport {
    background-color: transparent;
}

.bx-wrapper .bx-pager.bx-default-pager a {
    width: 10px;
    height: 10px;
    border-color: #2d3436;
}

ul.list-posts > li img {
    margin: 0;
}

.bx-wrapper .bx-pager.bx-default-pager a:hover,
.bx-wrapper .bx-pager.bx-default-pager a.active {
    border-color: #f44336;
    background: #f44336;
}

.footer-links a {
    color: white;
}

footer .footer-widgets-part {
    padding-bottom: 0px;
}

.instagram {
    background: #f09433;
    background: -moz-linear-gradient(
        45deg,
        #f09433 0%,
        #e6683c 25%,
        #dc2743 50%,
        #cc2366 75%,
        #bc1888 100%
    );
    background: -webkit-linear-gradient(
        45deg,
        #f09433 0%,
        #e6683c 25%,
        #dc2743 50%,
        #cc2366 75%,
        #bc1888 100%
    );
    background: linear-gradient(
        45deg,
        #f09433 0%,
        #e6683c 25%,
        #dc2743 50%,
        #cc2366 75%,
        #bc1888 100%
    );
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f09433', endColorstr='#bc1888', GradientType=1);
}

.twitter {
    background-color: #3498db;
}

.facebook {
    background-color: #2980b9;
}

button.social-btn {
    border: none;
    width: 100px;
    height: 30px;
    color: white;
    font-size: 15px;
}

.standard-post2 .post-title {
    background-color: white;
}

@media (max-width: 768px) {
    .highlight {
        transform: scale(0.9);
    }
}

@media (max-width: 992px) {
    .unset-padding-bottom {
        padding-bottom: unset;
    }
}

@media (min-width: 992px) {
    .unset-padding-right {
        padding-right: unset;
    }
}

.min-h {
    min-height: 117px;
}

.pswp {
    z-index: 999999 !important;
}
</style>
