<template>
    <div class="about-more-autor">
        <ul class="nav nav-tabs custom-tabs">
            <li @click.prevent="changeTab(0)" :class="tab == 0 ? 'active' : ''">
                <a href="#about-autor" data-toggle="tab">live events</a>
            </li>

            <li @click.prevent="changeTab(1)" :class="tab == 1 ? 'active' : ''">
                <a href="#more-autor" data-toggle="tab">past events</a>
            </li>
            <li @click.prevent="changeTab(2)" :class="tab == 2 ? 'active' : ''">
                <a href="#more-autor" data-toggle="tab">upcoming events</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="margin-top" v-show="tab == 0">
                <div class="article-box" v-if="liveEventCollection.length">
                    <div
                        class="news-post article-post"
                        v-for="main in liveEventCollection"
                        :key="main.id"
                    >
                        <div class="row event-header">
                            <div class="col-sm-4">
                                <div
                                    class="post-gallery"
                                    style="background: rgb(231, 231, 231)"
                                >
                                    <img
                                        alt=""
                                        v-if="main.main_thumb"
                                        :src="main.main_thumb"
                                    />
                                    <div
                                        v-else
                                        class="default-img"
                                        :style="{
                                            backgroundImage:
                                                'url(' + defaultImg + ')',
                                        }"
                                    ></div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="post-content">
                                    <h2>{{ main.poker_tour }}</h2>
                                    <h2>{{ main.title }}</h2>
                                    <ul class="post-tags">
                                        <li class="finished bold">
                                            <i
                                                class="finished fa-solid fa-circle-dot"
                                            ></i
                                            >LIVE COVERAGE
                                        </li>
                                        <li>
                                            <i class="fa fa-clock-o"></i
                                            >{{ main.date_start }} -
                                            {{ main.date_end }}
                                        </li>
                                        <!-- <li><i class="fa fa-map-marker"></i>Location City, Country 1602</li>                                                                   -->
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div
                            class="row event-body"
                            v-for="event in main.events"
                            :key="event.id"
                        >
                            <div class="col-sm-6 post-content">
                                <p>
                                    <Link
                                        :href="`/event/${event.id}`"
                                        class="text-primary"
                                        >{{ event.title }}</Link
                                    >
                                </p>
                            </div>
                            <div class="col-sm-6 post-content">
                                <p class="text-right">
                                    <i class="fa fa-clock-o"></i>
                                    {{
                                        moment(event.date_start).format(
                                            "MMM D YYYY"
                                        )
                                    }}
                                    -
                                    {{
                                        moment(event.date_end).format(
                                            "MMM D YYYY"
                                        )
                                    }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <h4>No live event...</h4>
                </div>
            </div>

            <div class="margin-top" v-show="tab == 1">
                <div class="article-box" v-if="pastEventCollection.length">
                    <div
                        class="news-post article-post"
                        v-for="main in pastEventCollection"
                        :key="main.id"
                    >
                        <div class="row event-header">
                            <div class="col-sm-4">
                                <div
                                    class="post-gallery"
                                    style="background: rgb(231, 231, 231)"
                                >
                                    <img
                                        alt=""
                                        v-if="main.main_thumb"
                                        :src="main.main_thumb"
                                    />
                                    <div
                                        v-else
                                        class="default-img"
                                        :style="{
                                            backgroundImage:
                                                'url(' + defaultImg + ')',
                                        }"
                                    ></div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="post-content">
                                    <h2>{{ main.poker_tour }}</h2>
                                    <h2>{{ main.title }}</h2>
                                    <ul class="post-tags">
                                        <li>
                                            <i class="fa fa-clock-o"></i
                                            >{{ main.date_start }} -
                                            {{ main.date_end }}
                                        </li>
                                        <!-- <li><i class="fa fa-map-marker"></i>Location City, Country 1602</li>                                    -->
                                        <li></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div
                            class="row event-body"
                            v-for="event in main.events"
                            :key="event.id"
                        >
                            <div class="col-sm-6 post-content">
                                <p>
                                    <Link
                                        :href="`/event/${event.id}`"
                                        class="text-primary"
                                        >{{ event.title }}</Link
                                    >
                                </p>
                            </div>
                            <div class="col-sm-6 post-content">
                                <p class="text-right">
                                    <i class="fa fa-clock-o"></i> Ended:
                                    {{
                                        moment(event.date_end).format(
                                            "MMM D YYYY"
                                        )
                                    }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <h4>No past event...</h4>
                </div>
            </div>

            <div class="margin-top" v-show="tab == 2">
                <div class="article-box" v-if="upcomingEventCollection.length">
                    <div
                        class="news-post article-post"
                        v-for="main in upcomingEventCollection"
                        :key="main.id"
                    >
                        <div class="row event-header">
                            <div class="col-sm-4">
                                <div
                                    class="post-gallery"
                                    style="background: rgb(231, 231, 231)"
                                >
                                    <img
                                        alt=""
                                        v-if="main.main_thumb"
                                        :src="main.main_thumb"
                                    />
                                    <div
                                        v-else
                                        class="default-img"
                                        :style="{
                                            backgroundImage:
                                                'url(' + defaultImg + ')',
                                        }"
                                    ></div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="post-content">
                                    <h2>{{ main.poker_tour }}</h2>
                                    <h2>{{ main.title }}</h2>
                                    <ul class="post-tags">
                                        <li>
                                            <i class="fa fa-clock-o"></i
                                            >{{ main.date_start }} -
                                            {{ main.date_end }}
                                        </li>
                                        <!-- <li><i class="fa fa-map-marker"></i>Location City, Country 1602</li>                                                                      -->
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div
                            class="row event-body"
                            v-for="event in main.events"
                            :key="event.id"
                        >
                            <div class="col-sm-6 post-content">
                                <p>{{ event.title }}</p>
                            </div>
                            <div class="col-sm-6 post-content">
                                <p class="text-right">
                                    <i class="fa fa-clock-o"></i> Start at:
                                    {{
                                        moment(event.date_start).format(
                                            "MMM D YYYY"
                                        )
                                    }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <h4>No upcoming event...</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-top">
        <button @click="scrollToTop" class="btn btn-primary scroll-top-btn">
            <i class="fa-sharp fa-solid fa-chevron-up"></i>
        </button>
    </div>
</template>

<script setup>
import { onMounted, onBeforeUnmount, ref, watch } from "@vue/runtime-core";
import defaultImg from "/public/default-img.png";
import { Head, Link } from "@inertiajs/inertia-vue3";
import moment from "moment";

const props = defineProps({
    tournamentList: Object,
});

const tab = ref(0);

const changeTab = (currentTab) => {
    tab.value = currentTab;
};

const liveEventCollection = ref([]);
const pastEventCollection = ref([]);
const upcomingEventCollection = ref([]);

function stickyScroll() {
    const tabs = document.querySelector(".custom-tabs");
    const { top } = tabs.getBoundingClientRect();
    const scrollTopBtn = document.querySelector(".scroll-top");

    if (top <= 0) {
        tabs.style.borderBottomColor = "transparent";
        scrollTopBtn.style.display = "block";
        return;
    }
    scrollTopBtn.style.display = "none";
    tabs.style.borderBottomColor = "#f44336";
}

function scrollToTop() {
    window.scroll({ top: 0, behavior: "smooth" });
}

onMounted(() => {
    window.addEventListener("scroll", stickyScroll);
});
onBeforeUnmount(() => {
    window.removeEventListener("scroll", stickyScroll);
});

watch(
    () => props.tournamentList.data,
    (first) => {
        upcomingEventCollection.value = first.filter(
            ({ status }) => status === "upcoming"
        );
        pastEventCollection.value = first.filter(
            ({ status }) => status === "past"
        );
        liveEventCollection.value = first.filter(
            ({ status }) => status === "live"
        );
    }
);
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
    box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.5);
}

.default-img {
    aspect-ratio: 3 / 2;
    width: 100%;
    height: auto;
    background-position: center;
    background-repeat: no-repeat;
    background-size: contain;
}

.margin-top {
    margin-top: 20px;
}

.event-body {
    margin: 20px 1px;
    border: 1px solid #b5b5b5;
}

.event-header {
    color: white;
    padding-top: 20px;
    background-color: #2d3436;
    margin: 0px 1px;
}

.event-header .col-sm-4 {
    padding-right: 0;
}

.article-post {
    border-bottom: 1px solid #d3d3d3;
}

.article-post .post-content {
    padding: 5px 10px;
}

.article-post .post-content h2 {
    color: white;
}

.article-post .post-content p {
    font-size: 14px;
}
.single-post-box .post-gallery img {
    margin-bottom: unset;
}

.article-post .post-header {
    display: flex;
    align-items: center;
}

.sidebar .tab-posts-widget ul.nav-tabs {
    display: flex;
    align-items: center;
    overflow-x: auto;
}

.sidebar .tab-posts-widget ul.nav-tabs li {
    padding-left: 1px;
}

.post-gallery .mainEventImage {
    width: 170px;
    height: auto;
}
.post-gallery {
    float: none;
}

.post-gallery .mainEventImage {
    width: 100%;
    height: 100%;
    width: 230px;
    min-width: 150px;
    min-height: auto;
}

.sidebar {
    padding-bottom: unset;
}

.subevent {
    margin: 0px 15px 15px 15px;
    border: 1px solid #d8d8d8;
}

.subevent.live-now {
    border: 1px solid #2ecc71 !important;
}

.post-header {
    background: #2d3436;
    padding: 15px 0px;
    margin: 0px 15px 15px 15px;
}

.post-header h2 {
    color: white;
    display: flex;
    flex-direction: row;
    align-items: center;
}

.post-content {
    color: white;
    margin-bottom: unset;
}

.event-status {
    font-weight: 800;
    font-style: normal;
}

.live {
    color: #f44336;
}

.finished {
    color: #2ecc71;
}

.post-tags {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.sidebar {
    padding-top: unset;
}
</style>
