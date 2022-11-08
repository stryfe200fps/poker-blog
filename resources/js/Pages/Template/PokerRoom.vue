<template>
    <Head>
        <title>{{ room.title }}</title>
    </Head>
    <FrontLayout>
        <div class="block-content">
            <div class="article-box">
                <div class="title-section">
                    <h1 class="text-primary">
                        <span style="cursor: pointer" @click="goBack"
                            ><i
                                class="fa fa-chevron-left"
                                aria-hidden="true"
                            ></i>
                            to poker room</span
                        >
                    </h1>
                </div>
                <div
                    class="news-post article-post"
                    style="margin-bottom: 50px; padding-bottom: 30px"
                >
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="post-content">
                                <h2
                                    class="text-capitalize"
                                    style="margin-bottom: 15px"
                                >
                                    <span>{{ room.title }} </span>
                                </h2>
                                <ul class="post-tags post-tags--custom">
                                    <li v-if="room.country">
                                        <i
                                            ><CountryFlag
                                                :title="room.country?.name"
                                                :iso="room.country?.code"
                                        /></i>
                                        {{ room.country?.name }}
                                    </li>
                                    <li v-if="room.address">
                                        <i class="fas fa-map-marker-alt"></i
                                        >{{ room.address }}
                                    </li>
                                    <li v-if="room.phone">
                                        <i class="fas fa-mobile-android-alt"></i
                                        >{{ room.phone }}
                                    </li>
                                    <li
                                        class="text-lowercase"
                                        v-if="room.email"
                                    >
                                        <a :href="`mailto:${room.email}`"
                                            ><i class="fas fa-envelope"></i
                                            >{{ room.email }}</a
                                        >
                                    </li>
                                    <li
                                        class="text-lowercase"
                                        v-if="room.website"
                                    >
                                        <a
                                            :href="`${room.website}`"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            ><i class="fas fa-globe"></i
                                            >{{
                                                room.website?.replace(
                                                    /(^\w+:|^)\/\//,
                                                    ""
                                                )
                                            }}</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="post-gallery">
                                <img
                                    v-if="room.image"
                                    :src="room.image"
                                    :alt="room.image"
                                />
                                <img
                                    v-else
                                    :src="defaultImg"
                                    :alt="defaultImg"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-bottom: 60px" v-if="room.description">
                    <div class="title-section">
                        <h1><span>Description</span></h1>
                    </div>
                    <p>{{ room.description }}</p>
                </div>
                <div style="margin-bottom: 60px" v-if="room.features">
                    <div class="title-section">
                        <h1><span>Features</span></h1>
                    </div>
                    <ul>
                        <li
                            v-for="(feature, index) in room.features"
                            :key="index"
                            style="list-style-type: disc"
                        >
                            {{ feature.feature }}
                        </li>
                    </ul>
                </div>
                <div v-if="room.content">
                    <div class="title-section">
                        <h1><span>General Information</span></h1>
                    </div>
                    <p class="room-content" v-html="room.content"></p>
                </div>
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useRoomStore } from "@/Stores/pokerRoom.js";
import { onMounted, ref } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";

import FrontLayout from "@/Layouts/FrontLayout.vue";
import CountryFlag from "vue3-country-flag-icon";
import defaultImg from "/public/default-img.png";

const props = defineProps({
    room: {
        type: Object,
    },
});

const room = ref([]);
const pokerRoomStore = useRoomStore();

function goBack() {
    Inertia.visit("/poker-rooms");
}

onMounted(async () => {
    await pokerRoomStore.getSingleRoom(props.room.slug);
    room.value = pokerRoomStore.singleRoom.data;
});
</script>

<style scoped>
:deep(.room-content p) {
    padding: unset !important;
    font-size: 16px;
}

:deep(.room-content h2) {
    padding: 0;
}

:deep(.room-content ol li) {
    font-size: 16px;
    list-style: decimal;
}

:deep(.room-content ul li) {
    font-size: 16px;
    list-style: disc;
}

:deep(.room-content ol li a) {
    color: #f44336;
}

:deep(.room-content table) {
    width: 100%;
    margin-bottom: 10px;
    border: 1px solid #95a5a662;
}

:deep(.room-content table tr td) {
    padding: 5px 10px;
    font-family: Lato, sans-serif;
    font-size: 14px;
    background-color: #fbfbfb;
}

.post-gallery {
    float: none !important;
    margin-inline: 0 !important;
    margin-block-end: 0 !important;
}

.post-tags--custom {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-direction: column;
    gap: 5px;
}

.post-tags--custom li {
    font-size: 14px;
    font-style: normal;
    color: inherit;
}

.post-tags--custom li i {
    color: inherit;
}

.post-tags--custom li a {
    color: inherit;
}
</style>
