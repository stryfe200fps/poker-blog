<template>
    <div class="col-md-6">
        <div
            class="news-post image-post"
            style="margin-bottom: 30px"
            v-if="report.status === 'live'"
        >
            <span class="custom-label text-uppercase">live now</span>
            <img
                v-if="report.image_set"
                :src="report.image_set.md_image"
                :alt="report.image_set.md_image"
                loading="lazy"
            />
            <img v-else :src="defaultImg" :alt="defaultImg" loading="lazy" />
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
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

import defaultImg from "/public/default-img.png";

const props = defineProps({
    report: {
        type: Object,
    },
});
</script>

<style scoped>
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
