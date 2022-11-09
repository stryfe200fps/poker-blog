<script setup>
import defaultImg from "/public/default-img.png";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useArticleStore } from "@/Stores/article.js";
import { useEventStore } from "@/Stores/event.js";
import { useBannerStore } from "@/Stores/banner.js";
import { onMounted, ref } from "@vue/runtime-core";
import moment from "moment";

const articleStore = useArticleStore();
const eventStore = useEventStore();
const bannerStore = useBannerStore();
const banner = ref([]);

onMounted(async () => {
    await eventStore.getMainEvents();
    await bannerStore.getBanners();
    banner.value = await bannerStore.getMainBanner();
});

function showArticle(date, slug) {
    Inertia.visit(
        `/news/${moment(new Date(date)).format("YYYY")}/${moment(
            new Date(date)
        ).format("MM")}/${slug}`
    );
}

function visitBanner(url) {
    if (url) window.open(url, "_blank");
}

defineProps({
    articleList: {
        type: Object,
        default: {},
    },
});
</script>

<template>
    <Head>
        <title>Home</title>
    </Head>
    <div class="block-content">
        <div class="grid-box" v-if="eventStore.mainEvents.data?.length">
            <div class="title-section">
                <h1><span>live reporting</span></h1>
            </div>
            <div class="row">
                <div
                    class="col-md-6"
                    v-for="(report, index) in eventStore.mainEvents.data"
                    :key="index"
                >
                    <div
                        class="news-post image-post"
                        style="margin-bottom: 30px"
                        v-if="report.status === 'live'"
                    >
                        <span class="custom-label text-uppercase"
                            >live now</span
                        >
                        <img
                            v-if="report.image_set"
                            :src="report.image_set.md_image"
                            :alt="report.image_set.md_image"
                        />
                        <img v-else :src="defaultImg" :alt="defaultImg" />
                        <Link
                            :href="`/tours/${report.tour_slug}/${report.tournament_slug}/${report.slug}`"
                        >
                            <div class="hover-box" style="inset: 0">
                                <div class="inner-hover">
                                    <h2>
                                        <Link
                                            :href="`/tours/${report.tour_slug}/${report.tournament_slug}/${report.slug}`"
                                            >{{ report.title }}</Link
                                        >
                                    </h2>
                                    <p class="text-white">
                                        {{ report.tournament }}
                                    </p>
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid-box">
            <div class="title-section">
                <h1>
                    <span>Lates news</span>
                </h1>
            </div>
            <div
                class="advertisement"
                v-if="banner"
                :style="{ cursor: banner.url ? 'pointer' : 'auto' }"
                @click="visitBanner(banner.url)"
            >
                <div class="desktop-advert">
                    <img
                        :src="banner.image_set?.og_image"
                        :alt="banner.image_set?.lg_image"
                        class="img-responsive"
                    />
                </div>
                <div class="tablet-advert">
                    <img
                        :src="banner.image_set?.og_image"
                        :alt="banner.image_set?.og_image"
                        class="img-responsive"
                    />
                </div>
                <div class="mobile-advert">
                    <img
                        :src="banner.image_set?.og_image"
                        :alt="banner.image_set?.og_image"
                        class="img-responsive"
                    />
                </div>
            </div>
            <div
                class="news-post article-post"
                v-for="news in articleList.data"
                :key="news.id"
                style="margin-bottom: 30px"
            >
                <div
                    class="row"
                    @click="showArticle(news.date, news.slug)"
                    style="cursor: pointer"
                >
                    <div class="col-sm-6">
                        <div class="post-gallery">
                            <img
                                v-if="news.image_set"
                                :src="news.image_set.md_image"
                                :alt="news.image_set.md_image"
                            />
                            <img v-else :src="defaultImg" :alt="defaultImg" />

                            <Link
                                v-if="news.categories.length"
                                class="category-post food"
                                :href="news.categories[0]?.slug"
                                >{{ news.categories[0]?.title }}</Link
                            >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="post-content">
                            <h2>
                                <Link
                                    :href="`/news/${moment(
                                        new Date(news.date)
                                    ).format('YYYY')}/${moment(
                                        new Date(news.date)
                                    ).format('MM')}/${news.slug}`"
                                    v-html="news.title"
                                >
                                </Link>
                            </h2>
                            <p v-html="news.description"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid-box">
            <div class="title-section">
                <h1><span>video</span></h1>
            </div>
            <div class="news-post article-post">
                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 20px">
                        <div class="new-post standard-post2">
                            <div
                                class="embed-responsive embed-responsive-16by9"
                            >
                                <iframe
                                    class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/S2SSslc8wBs"
                                    title="APT Philippines 2022 Main Event Highlights"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                ></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe
                                class="embed-responsive-item"
                                src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2FPokerStarsAsia%2Fvideos%2F1775890926121412%2F&show_text=false&width=560&t=0"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                style="aspect-ratio: 16 / 9"
                            ></iframe>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe
                                class="embed-responsive-item"
                                src="https://www.youtube.com/embed/bNZd_JIKNKE"
                                title="WPT Prime Vietnam - Day 1 highlights"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* .grid-box .news-post,
.grid-box ul.list-posts {
    margin-bottom: 30px;
} */
.post-gallery {
    float: none !important;
    margin-right: 0 !important;
    margin-left: 0 !important;
}

.custom-label {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 1;
    padding: 8px 16px;
    font-weight: bolder;
    background-color: #f44336;
    color: #fff;
}

.image-post:hover .hover-box {
    background: rgb(51 51 51 / 55%) !important;
}

.image-post:hover .hover-box .inner-hover h2 a {
    color: #fff !important;
}
</style>
