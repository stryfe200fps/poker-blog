<template>
    <div class="single-post-box">
        <div
            v-if="item.type !== 'level' && item.type !== 'content'"
            class="title-post"
            style="padding-top: 20px; border-top: 1px solid #d3d3d3"
        >
            <h1 :id="item.id">
                <Link
                    class="default-text-color"
                    :href="`/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/update-${item.id}`"
                    v-html="formattedTitle"
                ></Link>
            </h1>
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
                            <i class="fa fa-user"></i>by
                            <a href="#">{{ item.author?.name }}</a>
                        </li>
                        <li>
                            <i class="fa fa-clock-o"></i
                            >{{ item.realtime_published_date }}
                        </li>
                        <li v-if="item.level">
                            <i class="fa fa-bookmark"></i
                            >{{ item.level.level_value }}
                        </li>
                    </ul>
                </div>
                <div>
                    <ul class="post-tags share-post-links">
                        <div
                            class="share-post-mobile"
                            style="position: relative"
                        >
                            <ShareButtons
                                :isOpen="isOpen"
                                :url="`${url}/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/update-${item.id}`"
                            />
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
            v-if="item.type === 'report' || item.type === 'content'"
            :class="item?.image_set ? 'post-content-min-height' : ''"
            class="post-content"
        >
            <div
                class="post-gallery float-img"
                v-if="item.image_set"
                style="
                    float: left !important;
                    margin: 0px 15px 5px 0px !important;
                "
            >
                <div style="position: relative">
                    <img
                        :src="item.image_set?.md_image"
                        :alt="item.image_set?.md_image"
                        style="margin-bottom: unset"
                        :style="[
                            item.theme ? { filter: 'brightness(0.8)' } : {},
                        ]"
                    />
                    <div
                        v-if="item.theme"
                        class="imageFrame"
                        :style="{
                            'background-image': 'url(' + item.theme + ')',
                        }"
                    ></div>
                </div>
                <span v-if="item.caption" class="image-caption">{{
                    item.caption
                }}</span>
            </div>
            <div class="remove-padding" v-html="item.content"></div>
        </div>
        <div
            v-if="
                item.event_chips &&
                (item.type === 'report' || item.type === 'stack')
            "
        >
            <EachChipStack :eventChips="item.event_chips" />
        </div>
        <div
            class="post-tags-box margin-top"
            v-if="
                item.event_chips.length &&
                (item.type === 'report' || item.type === 'stack')
            "
            style="border: none"
        >
            <ul class="tags-box">
                <li><i class="fa fa-tags"></i><span>Tags:</span></li>
                <li v-for="tag in item.event_chips" :key="tag.id">
                    <a href="#" v-if="tag?.player">{{ tag?.player?.name }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { computed, ref } from "@vue/runtime-core";

import ShareButtons from "@/Components/Frontend/ShareButtons.vue";
import EachChipStack from "./EachChipStack.vue";

const props = defineProps({
    item: {
        type: Object,
    },
    event: {
        type: Object,
    },
    id: {
        type: Number,
    },
    url: {
        type: String,
    },
});

const isOpen = ref(false);

const formattedTitle = computed(() => {
    return (
        props.item?.title.charAt(0).toUpperCase() + props.item?.title.slice(1)
    );
});

function showShare() {
    isOpen.value = !isOpen.value;
}

function onClickOutside(event) {
    if (event.target.localName !== "a") {
        isOpen.value = false;
        return;
    }
}
</script>

<style scoped>
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

:deep(.remove-padding p) {
    padding-left: unset;
}

:deep(.remove-padding h1),
:deep(.remove-padding h2),
:deep(.remove-padding h3),
:deep(.remove-padding h4),
:deep(.remove-padding h5),
:deep(.remove-padding h6) {
    font-size: 16px;
    padding: 0;
}

:deep(.remove-padding ol li) {
    font-family: Lato, sans-serif;
    font-size: 16px;
    list-style: decimal;
    color: #666666;
}

:deep(.remove-padding ul li) {
    font-family: Lato, sans-serif;
    font-size: 16px;
    list-style: disc;
    color: #666666;
}

:deep(.remove-padding ol li a) {
    color: #f44336;
}

.single-post-box .post-tags-box ul.tags-box li a {
    margin-right: 8px;
    margin-bottom: 8px;
}

.text-secondary {
    color: #2d3436;
}

.text-green {
    color: #2ecc71;
}

.text-red {
    color: #e74c3c;
}

.single-post-box .post-tags-box {
    margin-left: 20px;
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

.each-post {
    border-top: 1px solid #d3d3d3;
    border-bottom: 1px solid #d3d3d3;
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
