<template>
    <header ref="sticky" class="clearfix">
        <!-- Bootstrap navbar -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <!-- Logo & advertisement -->
            <div class="logo-advertisement">
                <div class="container">
                    <div
                        style="
                            display: flex;
                            justify-content: space-between;
                            align-items: flex-start;
                            padding: 3rem 0;
                        "
                    >
                        <Link class="pull-left" href="/">
                            <img
                                src="/lop_logo_small.png"
                                alt=""
                                style="width: 150px"
                            />
                        </Link>
                        <button
                            @click="toggleBtn"
                            type="button"
                            class="navbar-toggle collapsed"
                            data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1"
                        >
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div
                            class="advertisement"
                            style="align-self: center; padding: 0"
                        >
                            <div class="desktop-advert">
                                <h4 style="color: white">
                                    “BRINGING THE ACTION TO YOUR DOORSTEP”
                                </h4>
                            </div>
                        </div>
                        <div
                            class="advertisement"
                            style="padding: 0; font-size: 12px"
                        >
                            <div class="desktop-advert" style="color: white">
                                <!-- <i class="fa fa-search" style="margin-right: 0.5rem"></i>
                                <span style="
                                    display: inline-block;
                                    margin-right: 0.5rem;
                                    font-size: 12px;
                                    color: white;
                                ">|</span>
                                <span style="display: inline-block; font-size: 12px; color: white">ENG<i
                                        class="fa fa-angle-down"
                                        style="margin-left: 1rem; font-size: 12px; color: #666"></i></span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Logo & advertisement -->

            <!-- navbar list container -->
            <div class="nav-list-container navbar navbar-default">
                <div class="container">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div
                        class="collapse navbar-collapse"
                        :class="{ in: toggleMenu }"
                        id="bs-example-navbar-collapse-1"
                    >
                        <ul class="nav navbar-nav navbar-left custome-nav">
                            <li class="drop">
                                <a style="cursor: pointer" class="home"
                                    >News & Info</a
                                >
                                <ul class="dropdown">
                                    <li>
                                        <Link
                                            style="
                                                cursor: pointer;
                                                background: #efefef;
                                            "
                                            href="/"
                                            >News</Link
                                        >
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <Link
                                    :class="{
                                        'router-link-active':
                                            route().current() === 'tournament',
                                    }"
                                    href="/tournament"
                                    >Live reporting</Link
                                >
                            </li>
                            <li>
                                <Link
                                    :class="{
                                        'router-link-active':
                                            calendar === '/event-calendar',
                                    }"
                                    href="/event-calendar"
                                    >Event Calendar</Link
                                >
                            </li>
                            <!-- <li><a class="tech" href="#">rankings & leaderboards</a></li>

                            <li><a class="fashion" href="#">packages</a></li>

                            <li><a class="video" href="#">store</a></li> -->

                            <li>
                                <Link
                                    :class="{
                                        'router-link-active':
                                            contact === '/contact',
                                    }"
                                    href="/contact"
                                    >contact</Link
                                >
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
            </div>
            <!-- End navbar list container -->
        </nav>
        <!-- End Bootstrap navbar -->
    </header>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref, watch } from "vue";
import { Link, InertiaApp } from "@inertiajs/inertia-vue3";
import logo from "/public/lop_logo_small.png";
const toggleMenu = ref(false);
const windowTop = ref(0);

function toggleBtn() {
    toggleMenu.value = !toggleMenu.value;
}

const contact = ref("");
const calendar = ref("");
const sticky = ref(null);
onMounted(() => {
    contact.value = window.location.pathname;
    calendar.value = window.location.pathname;
    const pathname = window.location.pathname.split("/")[1];
    if (pathname !== "tournament" && pathname !== "event")
        window.addEventListener("scroll", onScroll);
});
onBeforeUnmount(() => {
    window.removeEventListener("scroll", onScroll);
});

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
</script>

<style scoped>
.navbar-nav > li:nth-child(2) > a:after,
.navbar-nav > li:nth-child(3) > a:after,
.navbar-nav > li:nth-child(4) > a:after {
    display: none;
}

.navbar-nav > li:nth-child(2) > a,
.navbar-nav > li:nth-child(3) > a,
.navbar-nav > li:nth-child(4) > a {
    padding-left: 12px;
    padding-right: 12px;
}

.router-link-active,
.router-link-exact-active {
    background-color: #f44336 !important;
    color: white;
}
header.active .nav-list-container {
    border-radius: unset;
}

a.router-link-active:hover {
    color: white !important;
    background-color: #f44336 !important;
}

.navbar-nav > li > a.router-link-active:hover {
    color: white !important;
}

.navbar-nav > li > a:hover,
.navbar-nav > li > a:hover::after {
    color: #f44336 !important;
}
</style>
