<template>
    <Head>
        <title>{{ report.data.title_tab }}</title>
    </Head>
    <div class="block-content">
        <div class="title-section">
            <h1 class="text-primary">
                <span style="cursor: pointer" @click="goBack"
                    ><i class="fa fa-chevron-left" aria-hidden="true"></i> to
                    event report</span
                >
            </h1>
        </div>
        <div class="single-post-box">
            <div class="title-post">
                <h1 v-html="formattedTitle"></h1>
                <div
                    style="
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    "
                >
                    <div style="flex-grow: 1">
                        <ul class="post-tags">
                            <li>
                                <i class="fa fa-clock-o"></i
                                >{{ report.data.date_for_humans }}
                            </li>
                            <li>
                                <i class="fa fa-user"></i>by
                                <a href="#">{{ report.data.author.name }}</a>
                            </li>
                            <li v-if="report.data.level">
                                <i class="fa fa-bookmark"></i>
                                {{ report.data.level.level_value }}
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="post-tags share-post-links">
                            <div
                                class="share-post-mobile"
                                style="position: relative"
                            >
                                <ShareButtons :isOpen="isOpen" :url="url" />
                                <li
                                    @click="showShare"
                                    v-click-outside-element="onClickOutside"
                                    class="btn btn-default share-btn-mobile"
                                >
                                    <i class="fa fa-share-alt"></i
                                    ><span class="text-uppercase">Share</span>
                                </li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div
                :class="report.data.image_set ? 'post-content-min-height' : ''"
                class="post-content"
            >
                <div
                    class="post-gallery float-img"
                    v-if="report.data.image_set"
                    style="
                        float: left !important;
                        margin: 0px 15px 5px 0px !important;
                    "
                >
                    <div style="position: relative">
                        <img
                            :src="report.data.image_set.lg_image"
                            alt=""
                            style="margin-bottom: unset"
                            :style="[
                                report.data.theme
                                    ? { filter: 'brightness(0.8)' }
                                    : {},
                            ]"
                        />
                        <div
                            v-if="report.data.theme"
                            class="imageFrame"
                            :style="{
                                'background-image':
                                    'url(' + report.data.theme + ')',
                            }"
                        ></div>
                    </div>
                    <span v-if="report.data.caption" class="image-caption">{{
                        report.data.caption
                    }}</span>
                </div>
                <div class="remove-padding" v-html="report.data.content"></div>
            </div>
            <div v-if="report.data.event_chips" style="margin-bottom: 20px">
                <EachChipStack :eventChips="report.data.event_chips" />
            </div>
            <div v-if="report.data?.event_chips?.length">
                <div class="post-tags-box">
                    <ul class="tags-box">
                        <li>
                            <i class="fa fa-tags"></i><span>Tags:</span
                            ><a
                                href="#"
                                v-for="(tag, index) in report.data?.event_chips"
                                :key="index"
                                >{{ tag.player?.name }}</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
            <p style="margin-top: 25px">
                &copy; 2021-{{ currentDate }} Life of poker. All rights
                reserved.
            </p>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { ref, computed } from "@vue/runtime-core";
import moment from "moment";

import ShareButtons from "@/Components/Frontend/ShareButtons.vue";
import EachChipStack from "@/Components/Frontend/Report/EachChipStack.vue";

const props = defineProps({
    report: {
        type: Object,
    },
});

const isOpen = ref(false);
const url = ref(window.location.href);

const formattedTitle = computed(() => {
    return (
        props.report.data?.title.charAt(0).toUpperCase() +
        props.report.data?.title.slice(1)
    );
});

const currentDate = computed(() => {
    return moment().format("YYYY");
});

function showShare() {
    isOpen.value = !isOpen.value;
}

function goBack() {
    Inertia.visit(url.value.slice(0, url.value.lastIndexOf("/")));
}

function onClickOutside(event) {
    if (event.target.localName !== "a") {
        isOpen.value = false;
        return;
    }
}
</script>

<style scoped>
:deep(.remove-padding p) {
    padding-left: unset;
}

:deep(.remove-padding table) {
    width: 100%;
    margin-bottom: 10px;
    border: 1px solid #95a5a662;
}

:deep(.remove-padding table tr td) {
    padding: 5px 10px;
    font-family: Lato, sans-serif;
    font-size: 14px;
    background-color: #fbfbfb;
}

.single-post-box .post-tags-box ul.tags-box {
    padding: 10px 20px;
}

.single-post-box .post-tags-box {
    margin-bottom: unset;
    border-bottom: 1px solid #d3d3d3;
}

.single-post-box .post-tags-box ul.tags-box li a {
    margin-right: 8px;
}

.text-secondary {
    color: #2d3436;
}

.imageFrame {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.margin-bottom {
    margin-bottom: 20px;
}

.margin-top {
    margin-top: 20px;
}

ul.post-tags li .facebook {
    background-color: unset;
    margin-right: unset;
}

ul.post-tags li .twitter {
    background-color: unset;
}

.twitter i {
    margin-right: 1px;
}

.facebook i {
    margin-right: 1px;
}

.whatsapp {
    background-color: unset;
    margin-right: unset;
    margin-left: unset;
}

.single-post-box .post-tags-box {
    padding: unset;
}

.share-btn-mobile {
    margin: 0;
}

.share-btn-mobile:focus {
    outline: none;
}

@media (min-width: 768px) {
    .post-content-min-height {
        min-height: 200px;
    }
}

@media (min-width: 992px) {
    .post-content-min-height {
        min-height: 270px;
    }
}

@media (min-width: 1200px) {
    .post-content-min-height {
        min-height: 320px;
    }
}
</style>
