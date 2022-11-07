<template>
    <div class="room-card" @click="showMedia(media.link)">
        <div class="news-post standard-post2">
            <div class="post-gallery">
                <img
                    v-if="media.image_set"
                    :src="media.image_set.md_image"
                    :alt="media.image_set.md_image"
                />
                <img v-else :src="defaultImg" :alt="defaultImg" />
            </div>
            <div class="post-title">
                <h2>
                    <a
                        :href="`${media.link}`"
                        class="text-capitalize"
                        target="_blank"
                        rel="noopener noreferrer"
                        >{{ media.title }}</a
                    >
                </h2>
                <!-- <ul class="post-tags">
                    <li v-if="room.country">
                        <i
                            ><CountryFlag
                                :title="room.country?.name"
                                :iso="room.country?.code"
                        /></i>
                        {{ room.country?.name }}
                    </li>
                </ul> -->
                <ul class="post-tags">
                    <li>
                        {{ media.description }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

import CountryFlag from "vue3-country-flag-icon";
import defaultImg from "/public/default-img.png";

const props = defineProps({
    media: {
        type: Object,
    },
});

function showMedia(link) {
    window.open(link, "_blank");
}
</script>

<style scoped>
.room-card {
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
