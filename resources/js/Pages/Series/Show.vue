<template>
    <Head>
        <title>{{ series.data.title }}</title>
    </Head>
    <FrontLayout>
        <div class="block-content">
            <div class="single-post-box">
                <div class="title-section">
                    <h1 class="text-primary">
                        <span style="cursor: pointer" @click="goBack"
                            ><i
                                class="fa fa-chevron-left"
                                aria-hidden="true"
                            ></i>
                            to event calendar</span
                        >
                    </h1>
                </div>
                <div class="title-post">
                    <h1>
                        {{ series.data.title }}
                    </h1>
                </div>
                <div class="post-gallery">
                    <img
                        v-if="series.data.image_set"
                        :src="series.data.image_set.lg_image"
                        :alt="series.data.image_set.lg_image"
                    />
                    <img v-else :src="defaultImg" :alt="defaultImg" />
                </div>
                <div class="post-content">
                    <div class="well">{{ series.data.description }}</div>
                </div>
                <div class="forum-table" v-if="series.data.events.data.length">
                    <div
                        class="table-head"
                        style="background-color: rgb(45, 52, 54) !important"
                    >
                        <div class="first-col" style="width: 25%">
                            <span>Date</span>
                        </div>
                        <div class="second-col" style="width: 50%">
                            <span>event</span>
                        </div>
                        <div class="third-col" style="width: 25%">
                            <span>buy in</span>
                        </div>
                    </div>
                    <EventTable
                        v-for="event in series.data.events.data"
                        :key="event.id"
                        :event="event"
                    />
                </div>
                <div v-if="series.data.content.length">
                    <p v-html="series.data.content"></p>
                </div>
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

import FrontLayout from "@/Layouts/FrontLayout.vue";
import EventTable from "./EventTable.vue";
import defaultImg from "/public/default-img.png";

const props = defineProps({
    series: {
        type: Object,
    },
});

function goBack() {
    Inertia.visit("/event-calendar");
}
</script>

<style scoped>
.post-gallery {
    float: none !important;
    margin-inline: 0 !important;
    margin-block-end: 0 !important;
}
</style>
