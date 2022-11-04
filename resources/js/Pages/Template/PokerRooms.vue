<template>
    <div class="room-card" @click="showRoom(room.slug)">
        <div class="news-post standard-post2">
            <div class="post-gallery">
                <img v-if="room.image" :src="room.image" :alt="room.image" />
                <img v-else :src="defaultImg" :alt="defaultImg" />
            </div>
            <div class="post-title">
                <h2>
                    <Link
                        :href="`/rooms/${room.slug}`"
                        class="text-capitalize"
                        >{{ room.title }}</Link
                    >
                </h2>
                <ul class="post-tags">
                    <li v-if="room.country">
                        <i
                            ><CountryFlag
                                :title="room.country?.name"
                                :iso="room.country?.code"
                        /></i>
                        {{ room.country?.name }}
                    </li>
                </ul>
                <ul class="post-tags">
                    <li>
                        {{ room.address }}
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
    room: {
        type: Object,
    },
});

function showRoom(slug) {
    Inertia.visit(`/rooms/${slug}`);
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
