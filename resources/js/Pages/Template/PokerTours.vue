<template>
    <div class="tour-card" @click="showTour(tour.slug)">
        <div class="news-post standard-post2">
            <div class="post-gallery">
                <img
                    v-if="tour.image_set"
                    :src="tour.image_set?.md_image"
                    :alt="tour.image_set?.md_image"
                />
                <img v-else :src="defaultImg" :alt="defaultImg" />
            </div>
            <div class="post-title">
                <h2>
                    <Link
                        :href="`/tours/${tour.slug}`"
                        class="text-capitalize"
                        >{{ tour.title }}</Link
                    >
                </h2>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

import defaultImg from "/public/default-img.png";

const props = defineProps({
    tour: {
        type: Object,
    },
});

function showTour(slug) {
    Inertia.visit(`/tours/${slug}`);
}
</script>

<style scoped>
.tour-card {
    cursor: pointer;
}

.post-gallery {
    float: none !important;
    margin-inline: 0 !important;
    margin-block-end: 0 !important;
}

.post-gallery img {
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}

.post-title {
    padding-inline: 10px !important;
    background-color: #fafafa;
    border-radius: 5px;
}
</style>
