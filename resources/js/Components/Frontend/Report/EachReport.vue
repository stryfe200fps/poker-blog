<template>
    <div class="single-post-box" v-if="item.type === 'report'">
        <div class="title-post">
            <h1 v-if="id == 1" :id="item.slug + id" class="text-capitalize">
                <Link
                    class="default-text-color"
                    :href="`/event/${event.slug}/report/${item.slug}`"
                    >{{ item.title }}</Link
                >
            </h1>
            <h1 v-else class="text-capitalize">
                <Link
                    class="default-text-color"
                    :href="`/event/${event.slug}/report/${item.slug}`"
                    >{{ item.title }}</Link
                >
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
                            <a href="#">{{ item.author?.name }} </a>
                        </li>
                        <li>
                            <i class="fa fa-clock-o"></i
                            >{{ item.date_for_humans }}
                        </li>
                        <li>
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
                                    class="btn"
                                    style="
                                        margin-right: 0;
                                        background-color: #1854dd;
                                    "
                                >
                                    <a
                                        target="_blank"
                                        :href="
                                            'https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Freport%2F' +
                                            item.slug +
                                            '&amp;src=sdkpreparse'
                                        "
                                        ><i
                                            class="fa-brands fa-facebook-f"
                                            style="margin-right: 0; color: #fff"
                                        ></i>
                                    </a>
                                </li>
                                <li
                                    class="btn"
                                    style="
                                        margin-right: 0;
                                        background-color: #18a3dd;
                                    "
                                >
                                    <a
                                        target="_blank"
                                        :href="
                                            'https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/report/' +
                                            item.slug
                                        "
                                        ><i
                                            class="fa fa-twitter"
                                            style="margin-right: 0; color: #fff"
                                        ></i
                                    ></a>
                                </li>
                                <li
                                    class="btn"
                                    style="background-color: #25d366"
                                >
                                    <a
                                        target="_blank"
                                        :href="
                                            'https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/report/' +
                                            item.slug
                                        "
                                        ><i
                                            class="fa fa-whatsapp"
                                            style="margin-right: 0; color: #fff"
                                        ></i
                                    ></a>
                                </li>
                            </div>
                            <li
                                @click="showShare"
                                @blur="isOpen = false"
                                class="btn btn-default share-btn-mobile"
                                tabindex="0"
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
            :class="item?.main_image ? 'post-content-min-height' : ''"
            class="post-content"
        >
            <div
                class="post-gallery float-img"
                v-if="item.main_image"
                style="float: left; margin: 0px 15px 5px 0px"
            >
                <div style="position: relative">
                    <img
                        :src="item.main_image"
                        alt=""
                        style="margin-bottom: unset"
                        :style="[
                            item.theme ? { filter: 'brightness(0.8)' } : {},
                        ]"
                    />
                    <div
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
        <div v-if="item.event_chips">
            <CustomeTable>
                <template v-slot:table-body>
                    <tr v-for="(item, index) in item.event_chips" :key="index">
                        <td v-if="item.player?.name != null">
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
                        <td
                            class="text-center hide-on-tablet"
                            v-if="item.player?.name && item.player?.country"
                        >
                            <CountryFlag
                                :title="item.player?.country"
                                :iso="item.player?.flag"
                            />
                        </td>
                        <td class="text-center hide-on-tablet" v-else>?</td>
                        <td v-if="item.player?.name != null" class="text-right">
                            {{
                                item.current_chips === 0
                                    ? "BUSTED"
                                    : item.current_chips.toLocaleString()
                            }}
                        </td>
                        <td
                            v-if="item.player?.name != null"
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
                    </tr>
                </template>
            </CustomeTable>
        </div>

        <div class="post-tags-box margin-top" v-if="item.event_chips.length">
            <ul class="tags-box">
                <li>
                    <i class="fa fa-tags"></i><span>Tags:</span
                    ><a
                        href="#"
                        v-for="tag in item.event_chips"
                        :key="tag.id"
                        >{{ tag?.player?.name }}</a
                    >
                </li>
            </ul>
        </div>
    </div>
    <div class="toast" :class="{ active: isActive }" @click="scrollToTop">
        <div class="toast-content">
            <i class="fas fa-info-circle info"></i>

            <div class="message">
                <span class="text text-1">New post - click here</span>
            </div>
        </div>
        <div class="progress" :class="{ active: isActive }"></div>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
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
});

const emit = defineEmits(["showNewReport"]);

// const items = ref([]);

const getDate = (date) => {
    let eventEndDate = props.item.event.date_end;
    let dateNow = moment().format("MMM D YYYY");
    if (dateNow > eventEndDate) return moment(date).format("MMM DD YYYY");
    return moment(date).fromNow();
};

// const newItem = ref(null);

const tab = ref(0);
const isOpen = ref(false);
const isActive = ref(false);
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
    }
}

function scrollToTop() {
    window.scroll({ top: 0, behavior: "smooth" });
    isActive.value = false;
}

onMounted(() => {
    window.Echo.channel("report").listen("NewReport", (e) => {
        emit("showNewReport");
        isActive.value = true;

        setTimeout(() => {
            isActive.value = false;
        }, 5000);
    });
});
</script>

<style scoped>
.toast {
    position: fixed;
    top: 25px;
    right: 30px;
    z-index: 1000;
    overflow: hidden;
    padding: 20px 35px 20px 25px;
    background-color: #fff;
    border-radius: 12px;
    cursor: pointer;
    box-shadow: 0 6px 20px -5px rgba(0, 0, 0, 0.5);
    transform: translateX(calc(100% + 30px));
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
}

.toast.active {
    transform: translateX(0%);
}

.toast .toast-content {
    display: flex;
    align-items: center;
}

.toast-content .info {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
}

.toast-content .message {
    display: flex;
    flex-direction: column;
    margin: 0 20px;
}

.message .text {
    font-size: 16px;
    font-weight: 400;
    color: #666666;
}

.message .text.text-1 {
    font-weight: 600;
    color: #333;
}

.toast .progress {
    position: absolute;
    bottom: -20px;
    left: 0;
    width: 100%;
    height: 3px;
}

.toast .progress:before {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background-color: #f44336;
}

.progress.active:before {
    animation: progress 5s linear forwards;
}

@keyframes progress {
    100% {
        right: 100%;
    }
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

:deep(.remove-padding p) {
    padding-left: unset;
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
