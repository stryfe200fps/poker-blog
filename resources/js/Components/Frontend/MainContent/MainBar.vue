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
                    <LiveReportCard
                        v-for="(report, index) in liveEvents"
                        :key="index"
                        :report="report"
                    />
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
                    <BannerCard :banner="mainBanner" />
                </div>
                <ArticleCard
                    v-for="news in articleList"
                    :key="news.id"
                    :news="news"
                />
            </div>
            <div class="grid-box" v-if="youtubeId.length">
                <div class="title-section">
                    <h1><span>video</span></h1>
                </div>
                <div class="news-post article-post">
                    <div class="row">
                        <YoutubeCard
                            v-for="(youtube, index) in youtubeId"
                            :key="index"
                            :youtube="youtube"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { computed } from "@vue/runtime-core";

import LoadingBar from "@/Components/LoadingBar.vue";
import LiveReportCard from "../LiveReportCard.vue";
import BannerCard from "../BannerCard.vue";
import ArticleCard from "../ArticleCard.vue";
import YoutubeCard from "../YoutubeCard.vue";

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

function visitBanner(url) {
    if (url) window.open(url, "_blank");
}
</script>
