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
                            back</span
                        >
                    </h1>
                </div>
                <div class="row" style="margin-bottom: 25px">
                    <div class="col-sm-6">
                        <div class="post-content">
                            <h2
                                class="text-capitalize"
                                style="margin-bottom: 15px"
                            >
                                <span>{{ series.data.title }}</span>
                            </h2>
                            <p>{{ series.data.description }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="post-gallery">
                            <img
                                v-if="series.data.image_set"
                                :src="series.data.image_set.lg_image"
                                :alt="series.data.image_set.lg_image"
                            />
                            <img v-else :src="defaultImg" :alt="defaultImg" />
                        </div>
                    </div>
                </div>
                <div class="forum-table" v-if="series.data.events.data.length">
                    <div
                        class="table-head"
                        style="background-color: rgb(45, 52, 54) !important"
                    >
                        <div class="first-col" style="width: 20%">
                            <span>Date</span>
                        </div>
                        <div class="second-col" style="width: 50%">
                            <span>event</span>
                        </div>
                        <div class="third-col" style="width: 15%">
                            <span>buy in</span>
                        </div>
                        <div class="third-col" style="width: 15%">
                            <span>fee</span>
                        </div>
                    </div>
                    <EventTable
                        v-for="event in series.data.events.data"
                        :key="event.id"
                        :event="event"
                    />
                </div>
                <div v-if="series.data.content.length">
                    <p class="series-content" v-html="series.data.content"></p>
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
    history.back();
    return false;
    // Inertia.visit("/event-calendar");
}
</script>

<style scoped>
.post-gallery {
    float: none !important;
    margin-inline: 0 !important;
    margin-block-end: 0 !important;
}

:deep(.series-content h1),
:deep(.series-content h2),
:deep(.series-content h3),
:deep(.series-content h4),
:deep(.series-content h5),
:deep(.series-content h6) {
    font-size: 16px;
    padding: series;
}

:deep(.series-content p) {
    padding: unset !important;
    font-size: 16px;
}

:deep(.series-content ol li) {
    font-size: 16px;
    list-style: decimal;
}

:deep(.series-content ul li) {
    font-size: 16px;
    list-style: disc;
}

:deep(.series-content ol li a) {
    color: #f44336;
}

:deep(.series-content table) {
    width: 100%;
    margin-bottom: 10px;
    border: 1px solid #95a5a662;
}

:deep(.series-content table tr td) {
    padding: 5px 10px;
    font-family: Lato, sans-serif;
    font-size: 14px;
    background-color: #fbfbfb;
}
</style>
