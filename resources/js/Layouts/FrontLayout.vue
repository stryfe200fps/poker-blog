<script setup>
import Header from "../Components/Frontend/Header.vue";
import Footer from "../Components/Frontend/Footer.vue";
import SideBar from "../Components/Frontend/MainContent/SideBar.vue";

import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/inertia-vue3";
import { onMounted, onBeforeUnmount, ref, computed } from "@vue/runtime-core";
import { useBannerStore } from "@/Stores/banner.js";
import Echo from "laravel-echo";

defineProps({
    title: String,
});

const isOpen = ref(false);
const isSetCookie = ref(false);
const preferences = ref([
    "Necessary",
    "Analytics",
    "Functionality",
    "Marketing",
]);
const selectedPreference = ref(["Necessary"]);
const bannerStore = useBannerStore();
const homeFullBanner = ref([]);
const homeSemiFullBanner = ref([]);
const homeSideBanner = ref([]);
const reportingFullBanner = ref([]);
const reportingSemiFullBanner = ref([]);
const reportingSideBanner = ref([]);

function openPreference() {
    isOpen.value = !isOpen.value;
}

function acceptAllCookies() {
    document.cookie = `lop=${preferences.value}; expires=Fri, 31 Dec 9999 23:59:59 GMT`;
    if (document.cookie) {
        isSetCookie.value = true;
    }
}

function visitBanner(url) {
    if (url) window.open(url, "_blank");
}

function savePreferenceCookie() {
    document.cookie = `lop=${selectedPreference.value}; expires=Fri, 31 Dec 9999 23:59:59 GMT`;
    if (document.cookie) {
        isSetCookie.value = true;
    }
}

function scrollToTop() {
    window.scroll({ top: 0, behavior: "smooth" });
}

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

const getCookie = computed(() => {
    const cookieArr = document.cookie.split(";");

    for (let i = 0; i < cookieArr.length; i++) {
        const cookiePair = cookieArr[i].split("=");

        if (cookiePair[0].trim() === "lop") {
            return true;
            // return decodeURIComponent(cookiePair[1]);
        }
    }
    return false;
});

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

Inertia.on("success", (event) => {
    console.log("event :>> ", event.detail.page.component);
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
});

onBeforeUnmount(() => {
    window.removeEventListener("scroll", showScrollTopBtn);
});
</script>

<template>
    <div class="active">
        <Header />
        <main>
            <section class="block-wrapper">
                <div
                    class="home-banner"
                    v-if="
                        formattedReportingBanner &&
                        (url.includes('live-reporting') ||
                            currentComponent === 'Event/Index')
                    "
                    :style="{
                        backgroundImage: `url(${formattedReportingBanner.image_set?.og_image})`,
                        cursor: formattedReportingBanner.url
                            ? 'pointer'
                            : 'auto',
                    }"
                    @click="visitBanner(formattedReportingBanner.url)"
                ></div>
                <div
                    class="home-banner"
                    v-if="
                        formattedHomeBanner &&
                        currentComponent === 'Index' &&
                        url === '/'
                    "
                    :style="{
                        backgroundImage: `url(${formattedHomeBanner.image_set?.og_image})`,
                        cursor: formattedHomeBanner.url ? 'pointer' : 'auto',
                    }"
                    @click="visitBanner(formattedHomeBanner.url)"
                ></div>
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
                            />
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <Footer />
        <div class="cookie row" :class="{ hide: getCookie || isSetCookie }">
            <div class="cookie__text col-sm-6 col-md-6">
                This website uses cookies to ensure you get the best experience
                on our website.
            </div>
            <div class="cookie__actions col-sm-6 col-md-6">
                <div>
                    <div class="cookie__buttons">
                        <button
                            type="button"
                            class="btn btn-link btn-block"
                            @click="openPreference"
                        >
                            Manage Cookies
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger btn-block"
                            @click="acceptAllCookies"
                        >
                            Accept All
                        </button>
                        <button
                            type="button"
                            class="btn btn-default btn-block save__btn"
                            :class="{ open: isOpen }"
                            @click="savePreferenceCookie"
                        >
                            Save Preference
                        </button>
                    </div>
                    <div class="cookie__preferences" :class="{ open: isOpen }">
                        <p>Manage Preference</p>
                        <div class="row" style="margin: 0 !important">
                            <div
                                class="cookie__preference col-xs-6 col-md-5"
                                v-for="(preference, index) in preferences"
                                :key="index"
                            >
                                <label class="switch">
                                    <input
                                        type="checkbox"
                                        :value="preference"
                                        :checked="preference === 'Necessary'"
                                        :disabled="preference === 'Necessary'"
                                        v-model="selectedPreference"
                                    />
                                    <span class="slider"></span>
                                </label>
                                {{ preference }}
                            </div>
                        </div>
                    </div>
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

<style>
.home-banner {
    position: fixed;
    inset: 0;
    width: 100%;
    min-height: 100vh;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: top center;
    image-rendering: -webkit-optimize-contrast;
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

.cookie {
    position: fixed;
    left: 0;
    bottom: 0;
    margin: 0 !important;
    width: 100%;
    padding: 2rem 1rem;
    background-color: #c4c4c4;
}

.cookie.hide {
    display: none;
}

.cookie__text {
    margin-bottom: 1.5rem;
    font-family: "Lato", sans-serif;
    font-size: 15px;
    color: #2d3436;
}

.cookie__actions button:focus {
    outline: none !important;
    text-decoration: none !important;
}

.save__btn {
    display: none !important;
}

.save__btn.open {
    display: block !important;
}

.cookie__preferences {
    display: none;
    margin-top: 1.3rem;
}

.cookie__preferences.open {
    display: block;
}

.cookie__preference {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 1rem;
    padding-left: 0 !important;
    font-family: "Lato", sans-serif;
    font-size: 14px;
}

.switch {
    position: relative;
    display: inline-block;
    width: 3.5em;
    height: 2em;
    margin-bottom: 0 !important;
    font-size: 8px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    inset: 0;
    background-color: #2d3436;
    transition: 0.4s;
    border-radius: 30px;
    cursor: pointer;
}

.slider:before {
    content: "";
    position: absolute;
    left: 0.3em;
    bottom: 0.3em;
    height: 1.4em;
    width: 1.4em;
    background-color: white;
    border-radius: 20px;
    transition: 0.4s;
}

input:checked + .slider {
    background-color: rgb(0, 221, 80);
}

input:focus + .slider {
    box-shadow: 0 0 1px rgb(0, 221, 80);
}

input:checked + .slider:before {
    transform: translateX(1.5em);
}

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

@media (min-width: 768px) {
    .cookie {
        display: flex;
    }

    .cookie__text {
        display: flex;
        align-items: center;
        margin-bottom: 0;
    }

    .cookie__actions {
        display: flex;
        justify-content: flex-end;
    }

    .cookie__actions .cookie__buttons {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cookie__actions button {
        display: inline-block;
        width: auto;
        margin: 0 !important;
    }
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

@media (max-width: 1599px) {
    .home-banner {
        display: none;
    }
}

@media (max-width: 452px) {
    .scroll-top {
        bottom: 20px;
        right: 20px;
    }
}

.min-h {
    min-height: 117px;
}

.pswp {
    z-index: 999999 !important;
}
</style>
