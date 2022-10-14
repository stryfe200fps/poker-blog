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
                        <div
                            class="advertisement"
                            style="overflow: visible; padding: 0"
                        >
                            <div class="desktop-advert">
                                <div class="header-actions">
                                    <!-- <i
                                        class="fa fa-search header-actions__icon"
                                    ></i>
                                    <h6 class="header-actions__icon">|</h6> -->
                                    <div id="google_translate_element"></div>
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
                            type="button"
                            class="navbar-toggle collapsed"
                            data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1"
                            style="align-self: center; margin: 0 15px 0 0"
                            @click="toggleBtn"
                        >
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="nav-list-container" style="border: 0">
                <div class="container">
                    <div
                        class="collapse navbar-collapse navbar-collapse--custom"
                        :class="{ in: toggleMenu }"
                        id="bs-example-navbar-collapse-1"
                    >
                        <ul
                            class="nav navbar-nav navbar-left navbar-nav--custom"
                        >
                            <li
                                class="drop"
                                v-for="menu in $page['props']['menu']"
                                :key="menu.id"
                            >
                                <Link
                                    class="home home--custom"
                                    :class="{
                                        child: menu.children.length,
                                        'router-link-active':
                                            pathname == menu.link,
                                    }"
                                    :href="'/' + menu.link"
                                    v-if="!menu.children.length"
                                >
                                    {{ menu.name }}
                                </Link>
                                <Link
                                    class="home home--custom"
                                    :class="{
                                        child: menu.children.length,
                                    }"
                                    v-else
                                >
                                    {{ menu.name }}
                                </Link>
                                <ul
                                    class="dropdown"
                                    v-if="menu.children.length"
                                >
                                    <li
                                        v-for="children in menu.children"
                                        :key="children.id"
                                    >
                                        <Link
                                            v-if="menu.link !== children.link"
                                            :href="
                                                '/' +
                                                menu.link +
                                                '/' +
                                                children.link
                                            "
                                            style="
                                                background: rgb(239, 239, 239);
                                            "
                                            >{{ children.name }}</Link
                                        >
                                        <Link
                                            v-else
                                            :href="'/' + children.link"
                                            style="
                                                background: rgb(239, 239, 239);
                                            "
                                            >{{ children.name }}</Link
                                        >
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref } from "vue";
import { Link, InertiaApp } from "@inertiajs/inertia-vue3";
import logo from "/public/lop_logo_small.png";
import slogan from "/public/header-slogan.png";

const toggleMenu = ref(false);
const windowTop = ref(0);
const sticky = ref(null);
const pathname = ref(window.location.pathname.split("/")[1]);

function toggleBtn() {
    toggleMenu.value = !toggleMenu.value;
}

function onScroll(e) {
    windowTop.value = e.target.documentElement.scrollTop;
    var width = document.body.clientWidth;

    if (width < 769) return;

    if (windowTop.value >= sticky.value.offsetTop + 100) {
        sticky.value.classList.add("active");
    } else {
        sticky.value.classList.remove("active");
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
    if (
        pathname.value !== "tournament" &&
        pathname.value !== "event" &&
        pathname.value !== "article"
    )
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
    background-image: url("background-black.jpg");
    background-color: #2d3436;
}

.header-logo {
    width: 150px;
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
    background-image: url("background-black.jpg");
    background-color: #2d3436;
}

.navbar-collapse--custom {
    overflow-y: scroll;
    scrollbar-width: none;
}

.navbar-collapse--custom::-webkit-scrollbar {
    display: none;
}

.navbar-nav--custom > li > a {
    color: #fff !important;
}

.navbar-nav--custom > li > a:before {
    display: none;
}

.navbar-nav > li:first-child > a {
    padding-left: 0 !important;
}

.home--custom {
    padding-right: 20px !important;
}

.home--custom.child {
    padding-right: 30px !important;
}

.home--custom::after {
    opacity: 0;
}

.home--custom.child::after {
    opacity: 1;
}

.navbar-nav > li > a:not(.router-link-active):hover,
.navbar-nav > li > a:not(.router-link-active):hover::after {
    color: #f44336 !important;
}

.router-link-active,
.router-link-exact-active {
    background-color: #f44336 !important;
    color: white;
}
</style>
