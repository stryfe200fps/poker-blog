<template>
    <Head>
        <title>Home</title>
    </Head>
    <div class="block-content">
        <div v-if="isLoading">
            <LoadingBar />
        </div>
        <div v-else>
            <div class="grid-box" v-if="liveEvents?.length">
                <div class="title-section">
                    <h1><span>live reporting</span></h1>
                </div>
                <div class="row">
                    <div
                        class="col-md-6"
                        v-for="(report, index) in liveEvents"
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
                                loading="lazy"
                            />
                            <img
                                v-else
                                :src="defaultImg"
                                :alt="defaultImg"
                                loading="lazy"
                            />
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
                        <span>Latest news</span>
                    </h1>
                </div>
                <div
                    class="advertisement"
                    v-if="mainBanner"
                    :style="{ cursor: mainBanner.url ? 'pointer' : 'auto' }"
                    @click="visitBanner(mainBanner.url)"
                >
                    <div class="desktop-advert">
                        <img
                            :src="mainBanner.image_set?.og_image"
                            :alt="mainBanner.image_set?.og_image"
                            loading="lazy"
                            style="max-width: 100%; height: auto"
                        />
                    </div>
                    <div class="tablet-advert">
                        <img
                            :src="mainBanner.image_set?.og_image"
                            :alt="mainBanner.image_set?.og_image"
                            loading="lazy"
                            style="max-width: 100%; height: auto"
                        />
                    </div>
                    <div class="mobile-advert">
                        <img
                            :src="mainBanner.image_set?.og_image"
                            :alt="mainBanner.image_set?.og_image"
                            loading="lazy"
                            style="max-width: 100%; height: auto"
                        />
                    </div>
                </div>
                <div
                    class="news-post article-post"
                    v-for="news in articleList"
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
                                    loading="lazy"
                                />
                                <img
                                    v-else
                                    :src="defaultImg"
                                    :alt="defaultImg"
                                    loading="lazy"
                                />
                                <Link
                                    v-if="news.categories.length"
                                    class="category-post food"
                                    :href="`/news/${news.categories[0]?.slug}`"
                                    @click.stop
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
            <div class="grid-box" v-if="youtubeId.length">
                <div class="title-section">
                    <h1><span>video</span></h1>
                </div>
                <div class="news-post article-post">
                    <div class="row">
                        <div
                            class="col-md-4"
                            style="margin-bottom: 20px"
                            v-for="(youtube, index) in youtubeId"
                            :key="index"
                        >
                            <div class="new-post standard-post2">
                                <div
                                    class="embed-responsive embed-responsive-16by9"
                                >
                                    <iframe
                                        class="embed-responsive-item"
                                        :src="`https://www.youtube.com/embed/${youtube}`"
                                        title="YouTube video player"
                                        frameborder="0"
                                        loading="lazy"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import LoadingBar from "@/Components/LoadingBar.vue";
import defaultImg from "/public/default-img.png";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import moment from "moment";
import { computed } from "@vue/runtime-core";

const props = defineProps({
    liveEvents: {
        type: Object,
    },
    mainBanner: {
        type: Object,
    },
    articleList: {
        type: Object,
    },
    ytLinks: {
        type: Object,
    },
    isLoading: {
        type: Boolean,
        default: true,
    },
});

const youtubeId = computed(() => {
    const mergedLinks = [];
    for (const key in props.ytLinks) {
        mergedLinks.push(props.ytLinks[key].split("/")[3]);
    }

    return mergedLinks;
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
</script>

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
