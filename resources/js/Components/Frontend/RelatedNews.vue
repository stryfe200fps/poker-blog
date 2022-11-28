<template>
    <div class="col-xs-12 col-md-4" style="margin-bottom: 30px">
        <div
            class="item news-post image-post3"
            style="cursor: pointer"
            @click="showArticle(related.date, related.slug)"
        >
            <img
                v-if="related.image_set"
                :src="related.image_set.md_image"
                :alt="related.image_set.md_image"
            />
            <img v-else :src="defaultImg" alt="" />
            <div class="hover-box">
                <h2>
                    <Link
                        :href="`/news/${moment(new Date(related.date)).format(
                            'YYYY'
                        )}/${moment(new Date(related.date)).format('MM')}/${
                            related.slug
                        }`"
                        v-html="related.title"
                    ></Link>
                </h2>
                <ul class="post-tags">
                    <li><i class="fa fa-clock-o"></i>{{ related.date }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import moment from "moment";

import defaultImg from "/public/default-img.png";

const props = defineProps({
    related: {
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
