<script setup>
import defaultImg from "/public/default-img.png";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useArticleStore } from "@/stores/article.js";
import { useEventStore } from "@/stores/event.js";
import { onMounted } from "@vue/runtime-core";

const articleStore = useArticleStore();
const eventStore = useEventStore();

onMounted(async () => {
    await eventStore.getMainEvents();
});

const showArticle = async (id) => {
    articleStore.getArticleBySlug(id);
};

defineProps({
    articleList: {
        type: Object,
        default: {},
    },
});
</script>

<template>
    <div
        class="article-box block-content"
        v-if="eventStore.mainEvents.data?.length"
    >
        <div class="title-section">
            <h1><span>Live reporting</span></h1>
        </div>
        <div class="row" style="margin-right: 0">
            <div
                class="col-lg-6 unset-padding-right"
                v-for="(report, index) in eventStore.mainEvents.data"
                :key="index"
            >
                <div class="news-post image-post" style="margin-bottom: 30px">
                    <span
                        v-if="report.status === 'live'"
                        style="
                            position: absolute;
                            top: 20px;
                            right: 20px;
                            background-color: #f44336;
                            color: #fff;
                            font-weight: bolder;
                            padding: 8px 16px;
                        "
                        >LIVE NOW</span
                    >
                    <span
                        v-else
                        style="
                            position: absolute;
                            top: 20px;
                            right: 20px;
                            background-color: #f44336;
                            color: #fff;
                            font-weight: bolder;
                            padding: 8px 16px;
                        "
                        >UPCOMING</span
                    >
                    <img
                        v-if="report.main_thumb"
                        :src="report.main_thumb"
                        :alt="report.main_thumb"
                    />
                    <img v-else :src="defaultImg" alt="" />
                    <Link :href="'/event/' + report.slug">
                        <div class="hover-box" style="inset: 0">
                            <div class="inner-hover">
                                <!-- <Link
                                class="category-post food"
                                :href="'/event/' + report.slug"
                                >{{ report.title }}</Link
                            > -->
                                <h2>
                                    <Link :href="'/event/' + report.slug">{{
                                        report.title
                                    }}</Link>
                                </h2>
                                <!-- <ul class="post-tags">
                                <li>
                                    <i class="fa fa-clock-o"></i
                                    ><span>27 may 2013</span>
                                </li>
                                <li>
                                    <a href="#"
                                        ><i class="fa fa-comments-o"></i
                                        ><span>20</span></a
                                    >
                                </li>
                            </ul> -->
                                <p>
                                    {{ report.tournament }}
                                </p>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div
                class="col-lg-6 unset-padding-right"
                v-for="(report, index) in eventStore.mainEvents.data"
                :key="index"
            >
                <div class="image-post-slider">
                    <div class="news-post image-post2">
                        <div class="post-gallery">
                            <Link :href="'/event/' + report.slug">
                                <img
                                    v-if="report.main_thumb"
                                    style="
                                        position: relative;
                                        filter: brightness(50%);
                                    "
                                    :src="report.main_thumb"
                                    alt=""
                                />
                                <img
                                    v-else
                                    style="background: #b9b9b9"
                                    :src="defaultImg"
                                />
                            </Link>
                            <Link :href="'/event/' + report.slug">
                                <h4
                                    style="
                                        position: absolute;
                                        left: 10px;
                                        bottom: 10px;
                                        color: white;
                                    "
                                >
                                    {{ report.title }}
                                </h4>
                            </Link>
                            <span
                                v-if="report.status === 'live'"
                                style="
                                    position: absolute;
                                    top: 20px;
                                    right: 20px;
                                    background-color: #f44336;
                                    color: #fff;
                                    font-weight: bolder;
                                    padding: 8px 16px;
                                "
                                >LIVE NOW</span
                            >
                            <span
                                v-else
                                style="
                                    position: absolute;
                                    top: 20px;
                                    right: 20px;
                                    background-color: #f44336;
                                    color: #fff;
                                    font-weight: bolder;
                                    padding: 8px 16px;
                                "
                                >UPCOMING</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <!-- <div class="article-box block-content" v-if="articleStore.list.data" style="margin-top: 30px;"> -->
    <div class="article-box block-content" v-if="1" style="margin-top: 30px">
        <div class="title-section">
            <h1><span>Latest News</span></h1>
        </div>

        <!-- <div class="news-post article-post" v-for="(news) in articleList.list.data" :key="news.id"> -->
        <div
            class="news-post article-post"
            v-for="news in articleList.data"
            :key="news.id"
        >
            <Link
                @click.prevent="showArticle(news.slug)"
                @mouseover="showArticle(news.slug)"
                :href="'/article/show/' + news.slug"
            >
                <div class="row">
                    <div class="col-sm-5">
                        <div class="post-gallery">
                            <Link
                                class="default-text-color"
                                @click.prevent="showArticle(news.slug)"
                                @mouseover="showArticle(news.slug)"
                                :href="'/article/show/' + news.slug"
                            >
                                <img
                                    alt=""
                                    v-if="news.main_image.length"
                                    :src="news.main_image"
                                />
                                <div
                                    v-else
                                    :style="{
                                        backgroundImage:
                                            'url(' + defaultImg + ')',
                                    }"
                                    style="
                                        aspect-ratio: 3/2;
                                        background-position: center;
                                        background-size: contain;
                                        background-repeat: no-repeat;
                                    "
                                ></div>
                            </Link>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="post-content">
                            <h2>
                                <Link
                                    :href="'/article/show/' + news.slug"
                                    class="default-text-color"
                                    >{{ news.title }}</Link
                                >
                            </h2>
                            <!-- <ul class="post-tags">
                            <li>
                                <i class="fa fa-clock-o"></i>{{ news.date }}
                            </li>
                        </ul> -->
                            <p>{{ news.description }}</p>
                            <!-- <Link :href="'/article/show/'+ news.slug" class="read-more-button"><i class="fa fa-arrow-circle-right"></i>Read More</Link> -->
                        </div>
                    </div>
                </div>
            </Link>
        </div>
    </div>

    <div class="article-box block-content">
        <div class="title-section">
            <h1><span class="">Video</span></h1>
        </div>

        <div class="row">
            <div
                class="col-md-4 news-post article-post"
                style="margin-bottom: 0"
            >
                <div class="news-post standard-post2 default-size">
                    <div class="post-gallery" style="background: transparent">
                        <iframe
                            width="100%"
                            height="auto"
                            src="https://www.youtube.com/embed/S2SSslc8wBs"
                            title="APT Philippines 2022 Main Event Highlights"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            style="aspect-ratio: 16 / 9"
                        ></iframe>
                    </div>
                </div>
            </div>
            <div
                class="col-md-4 news-post article-post"
                style="margin-bottom: 0"
            >
                <div class="news-post standard-post2 default-size">
                    <div class="post-gallery" style="background: transparent">
                        <iframe
                            width="100%"
                            height="auto"
                            src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2FPokerStarsAsia%2Fvideos%2F1775890926121412%2F&show_text=false&width=560&t=0"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            style="aspect-ratio: 16 / 9"
                        ></iframe>
                    </div>
                </div>
            </div>
            <div
                class="col-md-4 news-post article-post"
                style="margin-bottom: 0"
            >
                <div class="news-post standard-post2 default-size">
                    <div class="post-gallery" style="background: transparent">
                        <iframe
                            width="100%"
                            height="auto"
                            src="https://www.youtube.com/embed/bNZd_JIKNKE"
                            title="WPT Prime Vietnam - Day 1 highlights"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            style="aspect-ratio: 16 / 9"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.grid-box .news-post,
.grid-box ul.list-posts {
    margin-bottom: 30px;
}
.post-gallery {
    float: unset !important;
    margin-right: unset !important;
    margin-left: unset !important;
    background: #e7e7e7;
}

/* @media (max-width: 992px) { 
    .youtube-video {
        border: 2px solid red,;
        height: 360px;
    }
 } */
</style>
