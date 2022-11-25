<template>
    <div class="single-post-box">
        <div
            v-if="item.type !== 'level' && item.type !== 'content'"
            class="title-post"
            style="padding-top: 20px; border-top: 1px solid #d3d3d3"
        >
<<<<<<< HEAD
            <!-- <h1 v-if="id == 1" :id="item.id" class="text-capitalize">
=======
            <h1 v-if="id == 1" :id="item.id" class="text-capitalize">
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
                <Link
                    class="default-text-color"
                    :href="`/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/update-${item.id}`"
                    v-html="item.title"
                ></Link>
<<<<<<< HEAD
            </h1> -->
            <h1 :id="item.id">
                <Link
                    class="default-text-color"
                    :href="`/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/update-${item.id}`"
                    v-html="formattedTitle"
=======
            </h1>
            <h1 v-else class="text-capitalize">
                <Link
                    class="default-text-color"
                    :href="`/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/update-${item.id}`"
                    v-html="item.title"
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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
<<<<<<< HEAD
                        <li v-if="item.level">
=======
                        <li>
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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
                            <div
                                class="btn-group-vertical social-links-group"
                                :class="{ show: isOpen }"
                            >
                                <li
                                    class="btn custom-btn"
                                    style="
                                        margin-right: 0;
                                        background-color: #1854dd;
                                    "
                                >
                                    <a
                                        target="_blank"
                                        :href="`https://www.facebook.com/sharer/sharer.php?u=${url}/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/update-${item.id}&amp;src=sdkpreparse`"
                                        ><i
                                            class="fa-brands fa-facebook-f"
                                            style="margin-right: 0; color: #fff"
                                        ></i>
                                    </a>
                                </li>
                                <li
                                    class="btn custom-btn"
                                    style="
                                        margin-right: 0;
                                        background-color: #18a3dd;
                                    "
                                >
                                    <a
                                        target="_blank"
                                        :href="`https://twitter.com/intent/tweet?text=${url}/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/update-${item.id}`"
                                        ><i
                                            class="fa fa-twitter"
                                            style="margin-right: 0; color: #fff"
                                        ></i
                                    ></a>
                                </li>
                                <li
                                    class="btn custom-btn"
                                    style="background-color: #25d366"
                                >
                                    <a
                                        target="_blank"
                                        :href="`https://api.whatsapp.com/send?text=%0a${url}/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}/update-${item.id}`"
                                        ><i
                                            class="fa fa-whatsapp"
                                            style="margin-right: 0; color: #fff"
                                        ></i
                                    ></a>
                                </li>
                            </div>
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
            <CustomeTable>
                <template v-slot:table-body>
                    <tr v-for="(item, index) in item.event_chips" :key="index">
                        <td v-if="item.player?.name">
                            <img
                                class="hide-on-mobile"
                                v-if="item.player?.avatar"
                                :src="item.player?.avatar"
                            />
                            <img
                                class="hide-on-mobile"
                                v-else
                                :src="defaultAvatar"
                            />
                            {{ item.player?.name }}
                            <span style="white-space: nowrap"></span>
                        </td>
                        <td class="text-center hide-on-tablet" v-else>-</td>
                        <td
                            class="text-center hide-on-tablet"
                            v-if="item.player?.name && item.player?.country"
                        >
                            <CountryFlag
                                :title="item.player?.country"
                                :iso="item.player?.flag"
                            />
                        </td>
                        <td class="text-center hide-on-tablet" v-else>-</td>
                        <td v-if="item.player?.badge">
                            <img
                                :src="item.player?.badge"
                                :alt="item.player?.badge"
                            />
                        </td>
                        <td v-else></td>
                        <td v-if="item.player?.name" class="text-right">
                            {{
                                item.current_chips === 0
                                    ? "BUSTED"
                                    : item.current_chips.toLocaleString()
                            }}
                        </td>
                        <td class="text-center hide-on-tablet" v-else>-</td>
                        <td
                            v-if="item.player?.name"
                            class="text-right hide-on-mobile"
                        >
                            {{
                                item.current_chips === 0
                                    ? ""
                                    : item.changes.toLocaleString()
                            }}
                            <span
                                v-if="item.symbol === 'up'"
                                style="margin-left: 10px"
                                ><i
                                    v-if="item.current_chips != 0"
                                    class="fa-sharp fa-solid fa-caret-up text-green"
                                ></i
                            ></span>
                            <span v-else style="margin-left: 10px"
                                ><i
                                    v-if="item.current_chips != 0"
                                    class="fa-sharp fa-solid fa-caret-down text-red"
                                ></i
                            ></span>
                        </td>
                        <td class="text-center hide-on-tablet" v-else>-</td>
                    </tr>
                </template>
            </CustomeTable>
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
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
<<<<<<< HEAD
import { computed, onMounted } from "@vue/runtime-core";
=======
import { onMounted } from "@vue/runtime-core";
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
import CustomeTable from "../CustomeTable.vue";
import CountryFlag from "vue3-country-flag-icon";
import defaultAvatar from "@/default-avatar.png";
import moment from "moment";

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

<<<<<<< HEAD
const tab = ref(0);
const isOpen = ref(false);

const formattedTitle = computed(() => {
    return (
        props.item?.title.charAt(0).toUpperCase() + props.item?.title.slice(1)
    );
});

function onClickOutside(event) {
    if (event.target.localName !== "a") {
        isOpen.value = false;
        return;
=======
// const items = ref([]);

function onClickOutside(event) {
    if (event.target.localName !== "a") {
        isOpen.value = false;
        return;
    }
}

const getDate = (date) => {
    let eventEndDate = props.item.event.date_end;
    let dateNow = moment().format("MMM D YYYY");
    if (dateNow > eventEndDate) return moment(date).format("MMM DD YYYY");
    return moment(date).fromNow();
};

// const newItem = ref(null);

const tab = ref(0);
const isOpen = ref(false);
//const lastLevel = ref("");

const changeTab = (currentTab) => {
    tab.value = currentTab;
};

const showShare = () => {
    isOpen.value = !isOpen.value;
};

/* FRAMES */
function getFrame(theme) {
    switch (theme) {
        case "brokenMirror":
            return brokenMirror;
        case "bulletHole":
            return bulletHole;
        case "flames":
            return flames;
        case "happyBirthday":
            return happyBirthday;
        case "iceCubes":
            return iceCubes;
        case "pocketAces":
            return pocketAces;
        case "sunRays":
            return sunRays;
        case "waterLeaves":
            return waterLeaves;
        case "waterWaves":
            return waterWaves;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }
}

const changeTab = (currentTab) => {
    tab.value = currentTab;
};

const showShare = () => {
    isOpen.value = !isOpen.value;
};
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

.social-links-group {
    position: absolute;
    top: 0;
    left: 25%;
    z-index: 999;
    display: none;
    transform: translateY(-100px);
    transition: all 0.5s ease-in-out;
}

.social-links-group.show {
    display: block;
}

.custom-btn {
    padding: 0;
}

.custom-btn a {
    padding: 6px 12px;
}

.social-links-group::before {
    content: "";
    position: absolute;
    bottom: -3px;
    left: 50%;
    height: 8px;
    width: 8px;
    background-color: #25d366;
    transform: translate(-50%) rotate(45deg);
}

@media (min-width: 768px) {
    .post-content-min-height {
        min-height: 200px;
    }

    .show-on-mobile {
        display: none;
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
