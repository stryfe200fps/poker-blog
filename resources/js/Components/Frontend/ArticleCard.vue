<template>
    <div class="news-post article-post" style="margin-bottom: 30px">
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
                            :href="`/news/${moment(new Date(news.date)).format(
                                'YYYY'
                            )}/${moment(new Date(news.date)).format('MM')}/${
                                news.slug
                            }`"
                            v-html="news.title"
                        >
                        </Link>
                    </h2>
                    <p v-html="news.description"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import moment from "moment";

import defaultImg from "/public/default-img.png";

const props = defineProps({
    news: {
        type: Object,
    },
});

function showArticle(date, slug) {
    Inertia.visit(
        `/news/${moment(new Date(date)).format("YYYY")}/${moment(
            new Date(date)
        ).format("MM")}/${slug}`
    );
}
</script>

<style scoped>
.post-gallery {
    float: none !important;
    margin-right: 0 !important;
    margin-left: 0 !important;
}
</style>
