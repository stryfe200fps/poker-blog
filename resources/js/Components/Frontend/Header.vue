<template>
    <header ref="sticky" class="clearfix" style="z-index: auto !important">
        <nav
            ref="mobileHeader"
            class="navbar navbar-default navbar-static-top custom-header--bg mobile-header"
            role="navigation"
        >
            <div class="logo-advertisement custom-header--bg">
                <div class="container">
                    <div class="custom-header--flex">
                        <div class="navbar-header">
                            <Link
                                class="navbar-brand"
                                href="/"
                                style="padding: 0"
                            >
                                <img
                                    class="header-logo"
                                    :src="logo"
                                    alt="Logo"
                                />
                            </Link>
                        </div>
                        <div
                            class="advertisement"
                            style="align-self: center; padding: 0"
                        >
                            <div class="desktop-advert">
                                <img :src="slogan" alt="slogan" />
                            </div>
                        </div>
                        <div class="advertisement" style="height: 100%">
                            <div
                                class="desktop-advert"
                                style="
                                    position: absolute;
                                    top: 0;
                                    height: 100%;
                                    margin-left: -100px;
                                    filter: drop-shadow(8px 8px 10px #000);
                                "
                            >
                                <img
                                    :src="card"
                                    alt="card"
                                    style="width: 155px; padding-top: 8px"
                                />
                            </div>
                        </div>
                        <div class="button-actions">
                            <div
                                class="advertisement google-translate"
                                style="overflow: visible; padding: 0"
                            >
                                <div class="desktop-advert">
                                    <div class="header-actions">
                                        <TranslateDropdown
                                            :isLoading="isLoading"
                                        />
                                    </div>
                                </div>
                            </div>
                            <BurgerButton
                                :toggleMenu="toggleMenu"
                                @toggleBtn="toggleBtn"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <NavList :toggleMenu="toggleMenu" @closeMenu="closeMenu" />
        </nav>
    </header>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref } from "vue";
import { Link, usePage } from "@inertiajs/inertia-vue3";

import logo from "/public/lop_logo_white.svg";
import card from "/public/header-card.png";
import slogan from "/public/header-slogan.png";

import TranslateDropdown from "./TranslateDropdown.vue";
import NavList from "./NavList.vue";
import BurgerButton from "./BurgerButton.vue";

const sticky = ref(null);
const mobileHeader = ref(null);
const windowTop = ref(0);
const toggleMenu = ref(false);
const isLoading = ref(true);

function toggleBtn() {
    toggleMenu.value = !toggleMenu.value;
    if (toggleMenu.value) {
        document.body.style.overflow = "hidden";
        return;
    }
    document.body.style.overflow = "auto";
}

function closeMenu() {
    toggleMenu.value = false;
    document.body.style.overflow = "auto";
}

function onScroll(e) {
    if (usePage().component.value === "Article/Show") return;

    windowTop.value = e.target.documentElement.scrollTop;
    let width = document.body.clientWidth;
    const navImg = document.querySelector(".drop-img");

    if (width <= 767 && window.scrollY > 20) {
        mobileHeader.value.style.position = "fixed";
        mobileHeader.value.style.top = 0;
        mobileHeader.value.style.left = 0;
        mobileHeader.value.style.width = 100 + "%";
    } else {
        mobileHeader.value.style.position = "relative";
        mobileHeader.value.style.top = "unset";
        mobileHeader.value.style.left = "unset";
    }

    if (width < 769) return;

    if (windowTop.value >= sticky.value.offsetTop + 100) {
        sticky.value.classList.add("active");
        navImg.classList.add("scroll");
    } else {
        sticky.value.classList.remove("active");
        navImg.classList.remove("scroll");
    }
}

function googleTranslateElementInit() {
    new google.translate.TranslateElement(
        {
            pageLanguage: "en",
            includedLanguages: "zh-CN,zh-TW,en,ko,ja,es,nl",
        },
        "google_translate_element"
    );
    const targetElement = document.getElementById("google_translate_element");
    const select = document.getElementsByClassName("goog-te-combo");
    if (targetElement && select) {
        targetElement.addEventListener("DOMNodeInserted", () => {
            const options = select[0].options;
            Array.prototype.forEach.call(options, (element) => {
                switch (element.value) {
                    case "zh-CN":
                        element.text = "中文 (简体)";
                        break;
                    case "zh-TW":
                        element.text = "中文 (繁体)";
                        break;
                    case "nl":
                        element.text = "Nederlands";
                        break;
                    case "ja":
                        element.text = "にほんご";
                        break;
                    case "ko":
                        element.text = "한국어";
                        break;
                    case "es":
                        element.text = "Español";
                        break;
                    default:
                        element.text = "English";
                }
            });
        });

        isLoading.value = false;
    }
}
onMounted(() => {
    window.addEventListener("scroll", onScroll);
    setTimeout(() => {
        googleTranslateElementInit();
    }, 1500);
});

onBeforeUnmount(() => {
    window.removeEventListener("scroll", onScroll);
});
</script>

<style scoped>
.custom-header--bg {
    background-image: url("/background-black.jpg");
    background-color: #2d3436;
}

.custom-header--flex {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 3rem 0;
}

.header-logo {
    width: 150px;
}

.header-actions {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    gap: 10px;
    color: #fff;
}

header.active .nav-list-container {
    background-image: url("/background-black.jpg");
    background-color: #2d3436;
}

@media screen and (max-width: 767px) {
    .custom-header--flex {
        padding-block: 1rem;
    }

    .navbar-header {
        align-self: center;
    }

    .header-logo {
        width: 100px;
    }

    .advertisement .desktop-advert {
        display: block !important;
    }

    .button-actions {
        display: flex;
        align-items: center;
        align-self: center;
        gap: 20px;
    }

    .google-translate {
        display: block !important;
        margin-top: 20px;
    }
}
</style>
