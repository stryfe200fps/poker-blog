<template>
    <header ref="sticky" class="clearfix" style="z-index: auto !important">
        <nav
            class="navbar navbar-default navbar-static-top custom-header--bg"
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
                                    src="/lop_logo_white.svg"
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
                        <div class="button-actions">
                            <div
                                class="advertisement google-translate"
                                style="overflow: visible; padding: 0"
                            >
                                <div class="desktop-advert">
                                    <div class="header-actions">
                                        <!-- <i
                                        class="fa fa-search header-actions__icon"
                                    ></i>
                                    <h6 class="header-actions__icon">|</h6> -->
                                        <div
                                            id="google_translate_element"
                                        ></div>
                                        <!-- <label class="dropdown">
                                        <div class="dd-button">ENG</div>
                                        <input
                                            type="checkbox"
                                            class="dd-input"
                                            id="test"
                                        />
                                        <ul class="dd-menu">
                                            <li>Action</li>
                                            <li>Another action</li>
                                            <li>Something else here</li>
                                        </ul>
                                    </label> -->
                                    </div>
                                </div>
                            </div>
                            <button
                                class="hamburger hamburger--spin"
                                :class="{ 'is-active': toggleMenu }"
                                type="button"
                                @click="toggleBtn"
                            >
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-list-container" style="border: 0">
                <div class="container">
                    <div
                        class="collapse navbar-collapse navbar-collapse--custom"
                        :class="{ pull: toggleMenu }"
                        id="bs-example-navbar-collapse-1"
                    >
                        <ul
                            class="nav navbar-nav navbar-left navbar-nav--custom"
                        >
                            <li class="drop drop-img">
                                <Link href="/">
                                    <img
                                        class="drop-logo"
                                        src="/lop_logo_white.svg"
                                        alt="Logo"
                                    />
                                </Link>
                            </li>
                            <NavLinks
                                v-for="menu in $page['props']['menu']"
                                :key="menu.id"
                                :menu="menu"
                            />
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import logo from "/public/lop_logo_small.png";
import slogan from "/public/header-slogan.png";
import NavLinks from "./NavLinks.vue";

const toggleMenu = ref(false);
const windowTop = ref(0);
const sticky = ref(null);
const pathname = ref(window.location.pathname.split("/")[1]);

function toggleBtn() {
    toggleMenu.value = !toggleMenu.value;
    if (toggleMenu.value) {
        document.body.style.overflow = "hidden";
        return;
    }
    document.body.style.overflow = "auto";
}

function onScroll(e) {
    windowTop.value = e.target.documentElement.scrollTop;
    var width = document.body.clientWidth;
    const navImg = document.querySelector(".drop-img");

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
        { pageLanguage: "en", includedLanguages: "zh-CN,zh-TW,en,ko,ja,es,de" },
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
                    case "de":
                        element.text = "Deutsch";
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
        select[0].addEventListener("change", function () {
            if (select[0].value === "en") {
                window.location.reload();
            }
        });
    }
}
onMounted(() => {
    if (pathname.value !== "article")
        window.addEventListener("scroll", onScroll);

    let targetElement = document.getElementById("google_translate_element");
    if (targetElement) {
        targetElement.innerHTML = "";
        const script = document.createElement("script");
        script.type = "text/javascript";
        script.src =
            "https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";
        document.head.appendChild(script);
        setTimeout(() => {
            googleTranslateElementInit();
        }, 500);
        return;
    }
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

.header-logo {
    width: 150px;
}

.drop-logo {
    width: 80px;
}

.custom-header--flex {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 3rem 0;
}

.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    gap: 10px;
    color: #fff;
}

.dropdown {
    position: relative;
    display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    color: #fff;
}

.dd-button {
    display: inline-block;
    padding-right: 30px;
    white-space: nowrap;
    cursor: pointer;
}

.dd-button:after {
    content: "";
    position: absolute;
    top: 50%;
    right: 10px;
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid #fff;
    transform: translateY(-50%);
}

.dd-input {
    display: none;
}

.dd-menu {
    position: absolute;
    top: 100%;
    right: 0;
    margin: 2px 0 0 0;
    padding: 0;
    text-align: start;
    list-style-type: none;
    background-color: #ffffff;
    color: #222;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.1);
}

.dd-input + .dd-menu {
    display: none;
}

.dd-input:checked + .dd-menu {
    display: block;
}

.dd-menu li {
    padding: 10px 20px;
    cursor: pointer;
    white-space: nowrap;
}

.dd-menu li:hover {
    background-color: #f6f6f6;
}

header.active .nav-list-container {
    background-image: url("/background-black.jpg");
    background-color: #2d3436;
}

.collapse {
    display: block;
}

.navbar-collapse--custom {
    scrollbar-width: none;
}

.navbar-collapse--custom::-webkit-scrollbar {
    display: none;
}

.navbar-nav .drop-img a {
    padding-left: 0 !important;
}

.drop-img {
    display: none;
}

.drop-img.scroll {
    display: block;
}

.drop-img a::after {
    opacity: 0;
}

.navbar-nav--custom > li > a:before {
    display: none;
}

.hamburger {
    overflow: visible;
    display: none;
    font: inherit;
    text-transform: none;
    color: inherit;
    background-color: transparent;
    border: 0;
    cursor: pointer;
    transition-property: opacity, filter;
    transition-duration: 0.15s;
    transition-timing-function: linear;
}

.hamburger:hover {
    opacity: 0.7;
}

.hamburger.is-active:hover {
    opacity: 0.7;
}

.hamburger.is-active .hamburger-inner,
.hamburger.is-active .hamburger-inner::before,
.hamburger.is-active .hamburger-inner::after {
    background-color: #fff;
}

.hamburger-box {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 24px;
}

.hamburger-inner {
    top: 50%;
    display: block;
    margin-top: -2px;
}

.hamburger-inner,
.hamburger-inner::before,
.hamburger-inner::after {
    position: absolute;
    width: 35px;
    height: 3px;
    background-color: #fff;
    border-radius: 4px;
    transition: transform 0.15s ease;
}

.hamburger-inner::before,
.hamburger-inner::after {
    content: "";
    display: block;
}

.hamburger-inner::before {
    top: -10px;
}

.hamburger-inner::after {
    bottom: -10px;
}

.hamburger--spin .hamburger-inner {
    transition-duration: 0.22s;
    transition-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
}

.hamburger--spin .hamburger-inner::before {
    transition: top 0.1s 0.25s ease-in, opacity 0.1s ease-in;
}

.hamburger--spin .hamburger-inner::after {
    transition: bottom 0.1s 0.25s ease-in,
        transform 0.22s cubic-bezier(0.55, 0.055, 0.675, 0.19);
}

.hamburger--spin.is-active .hamburger-inner {
    transform: rotate(225deg);
    transition-delay: 0.12s;
    transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
}

.hamburger--spin.is-active .hamburger-inner::before {
    top: 0;
    opacity: 0;
    transition: top 0.1s ease-out, opacity 0.1s 0.12s ease-out;
}

.hamburger--spin.is-active .hamburger-inner::after {
    bottom: 0;
    transform: rotate(-90deg);
    transition: bottom 0.1s ease-out,
        transform 0.22s 0.12s cubic-bezier(0.215, 0.61, 0.355, 1);
}

@media screen and (max-width: 1199px) {
    .drop-img {
        padding-right: 15px;
    }

    .navbar-nav--custom > li > a {
        padding-inline-start: 20px;
    }
}

@media screen and (max-width: 767px) {
    .drop-img {
        display: none;
    }

    .custom-header--flex {
        padding-block: 1rem;
    }

    .navbar-header {
        align-self: center;
    }

    .header-logo {
        width: 100px;
    }

    .hamburger {
        display: inline-block;
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

    .navbar-nav--custom {
        margin-block: 0;
    }

    .navbar-collapse--custom {
        display: none;
        min-height: 100vh;
        background-color: #2a2828;
    }

    .navbar-collapse--custom.pull {
        display: block;
        animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
}

@media screen and (min-width: 769px) {
    .navbar-nav--custom {
        display: flex;
        align-items: center;
    }

    .navbar-nav--custom > li > a {
        padding-block: 15px;
    }
}
</style>
