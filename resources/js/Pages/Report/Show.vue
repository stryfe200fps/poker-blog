<template>
    <FrontLayout title="">
        <Head>
            <title>{{ report.data.title }}</title>
            <meta name="description" content="Your page description" />
            <meta property="og:title=" :content="report.data.title" />
            <meta property="og:description" :content="report.data.content" />
        </Head>

        <div class="block-content">
            <div class="title-section">
                <Link onclick="history.back();return false;"
                    ><h1 class="text-primary">
                        <span
                            ><i
                                class="fa fa-chevron-left"
                                aria-hidden="true"
                            ></i>
                            Back</span
                        >
                    </h1></Link
                >
            </div>

            <div class="single-post-box">
                <div
                    class="day-divider"
                    style="border-bottom: 1px solid #d3d3d3; margin-top: 20px"
                >
                    <span>Day: {{ report.data.day }}</span
                    ><br />
                    <span>{{ report.data.level.level }}</span
                    ><br />
                </div>
                <div class="title-post">
                    <h1>{{ report.data.title }}</h1>
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
                                    >{{
                                        moment(report.data.date_added).format(
                                            "MMM D YYYY"
                                        )
                                    }}
                                </li>
                                <li>
                                    <i class="fa fa-user"></i>by
                                    <a href="#"
                                        >{{
                                            report.data.article_author
                                                .first_name
                                        }}
                                        {{
                                            report.data.article_author.last_name
                                        }}
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-bookmark"></i>
                                    {{ report.data.level.level }}
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
                                                    report.data.slug +
                                                    '&amp;src=sdkpreparse'
                                                "
                                                ><i
                                                    class="fa-brands fa-facebook-f"
                                                    style="
                                                        margin-right: 0;
                                                        color: #fff;
                                                    "
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
                                                    report.data.slug
                                                "
                                                ><i
                                                    class="fa fa-twitter"
                                                    style="
                                                        margin-right: 0;
                                                        color: #fff;
                                                    "
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
                                                    report.data.slug
                                                "
                                                ><i
                                                    class="fa fa-whatsapp"
                                                    style="
                                                        margin-right: 0;
                                                        color: #fff;
                                                    "
                                                ></i
                                            ></a>
                                        </li>
                                    </div>
                                    <li
                                        @click="showShare"
                                        class="btn btn-default share-btn-mobile"
                                    >
                                        <i class="fa fa-share-alt"></i
                                        ><span class="text-uppercase"
                                            >Share</span
                                        >
                                    </li>
                                </div>
                                <div class="share-post-desktop">
                                    <li class="text-secondary">
                                        <i
                                            class="fa fa-share-alt text-secondary"
                                        ></i
                                        ><span class="text-secondary"
                                            >Share Post</span
                                        >
                                    </li>
                                    <li>
                                        <a
                                            target="_blank"
                                            :href="
                                                'https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Freport%2F' +
                                                report.data.slug +
                                                '&amp;src=sdkpreparse'
                                            "
                                            class="facebook"
                                            ><i
                                                class="fa fa-facebook text-secondary"
                                            ></i
                                        ></a>
                                    </li>
                                    <li>
                                        <a
                                            target="_blank"
                                            :href="
                                                'https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/report/' +
                                                report.data.slug
                                            "
                                            class="twitter"
                                            ><i
                                                class="fa fa-twitter text-secondary"
                                            ></i
                                        ></a>
                                    </li>
                                    <li>
                                        <a
                                            target="_blank"
                                            :href="
                                                'https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/report/' +
                                                report.data.slug
                                            "
                                            class="whatsapp"
                                            ><i
                                                class="fa fa-whatsapp text-secondary"
                                            ></i
                                        ></a>
                                    </li>
                                </div>
                            </ul>
                        </div>
                        <!-- <div>
                            <ul class="post-tags share-post-links">
                                <li style="margin-left: 2px;">
                                    <i class="fa fa-share-alt text-secondary"></i><span class="text-secondary">Share <span class="hide-on-smallest">Post</span></span>
                                </li>
                                <li ><a target="_blank" :href="'https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Freport%2F' + report.data.slug + '&amp;src=sdkpreparse'"  class="facebook"><i
                                            class="fa fa-facebook text-secondary"></i></a>
                                </li>
                                <li><a target="_blank" :href="'https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/report/' + report.data.slug" class="twitter"><i
                                            class="fa fa-twitter text-secondary"></i></a>
                                </li>
                                <li><a target="_blank" :href="'https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/report/' + report.data.slug" class="whatsapp"><i
                                            class="fa fa-whatsapp text-secondary"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
                <!-- <div class="title-post">
                    <h1>{{report.data.title}}</h1>
                    <div style="display:flex; justify-content: space-between;">
                        <div>
                            <ul class="post-tags">
                                <li><i class="fa fa-clock-o"></i>{{report.data.date_added}}</li>
                                <li><i class="fa fa-user"></i>by <a href="#">{{item.author.first_name}} {{item.author.last_name}}</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <ul class="post-tags share-post-links">
                                <li style="margin-left: 2px;">
                                    <i class="fa fa-share-alt text-secondary"></i><span class="text-secondary">Share <span class="hide-on-smallest">Post</span></span>
                                </li>
                                <li ><a target="_blank" :href="'https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Farticle%2Fshow%2F'+ '&amp;src=sdkpreparse'"  class="facebook"><i
                                            class="fa fa-facebook text-secondary"></i></a>
                                </li>
                                <li><a target="_blank" :href="'https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/article/show/'" class="twitter"><i
                                            class="fa fa-twitter text-secondary"></i></a>
                                </li>
                                <li><a target="_blank" :href="'https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/article/show/'" class="whatsapp"><i
                                            class="fa fa-whatsapp text-secondary"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div> -->

                <div
                    :class="
                        report.data.main_image ? 'post-content-min-height' : ''
                    "
                    class="post-content"
                >
                    <div
                        class="post-gallery float-img"
                        v-if="report.data.main_image"
                        style="float: left; margin: 0px 15px 5px 0px"
                    >
                        <div style="position: relative">
                            <img
                                :src="report.data.main_image"
                                alt=""
                                style="margin-bottom: unset"
                                :style="[
                                    report.data.theme
                                        ? { filter: 'brightness(0.8)' }
                                        : {},
                                ]"
                            />
                            <div
                                class="imageFrame"
                                :style="{
                                    'background-image':
                                        'url(' +
                                        getFrame(report.data.theme) +
                                        ')',
                                }"
                            ></div>
                        </div>
                        <span
                            v-if="report.data.caption"
                            class="image-caption"
                            >{{ report.data.caption }}</span
                        >
                    </div>
                    <div
                        class="remove-padding"
                        v-html="report.data.content"
                    ></div>
                </div>

                <div v-if="report.data.event_chips" style="margin-bottom: 20px">
                    <CustomeTable>
                        <template v-slot:table-body>
                            <tr
                                v-for="(item, index) in report.data.event_chips"
                                :key="index"
                            >
                                <td>
                                    <img
                                        class="hide-on-mobile"
                                        v-if="item.player.avatar"
                                        :src="item.player.avatar"
                                    />
                                    <img
                                        class="hide-on-mobile"
                                        v-else
                                        :src="defaultAvatar"
                                    />
                                    {{ item.player.name }}
                                    <span style="white-space: nowrap"></span>
                                </td>
                                <td
                                    class="text-center hide-on-tablet"
                                    v-if="item.player.country"
                                >
                                    <CountryFlag
                                        :title="item.player.country.name"
                                        :iso="item.player.country.iso_3166_2"
                                    />
                                </td>
                                <td class="text-center hide-on-tablet" v-else>
                                    ?
                                </td>
                                <td class="text-right">
                                    {{
                                        item.current_chips === 0
                                            ? "BUSTED"
                                            : item.current_chips.toLocaleString()
                                    }}
                                </td>
                                <td class="text-right hide-on-mobile">
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

                <div class="post-tags-box">
                    <ul class="tags-box">
                        <li>
                            <i class="fa fa-tags"></i><span>Tags:</span
                            ><a
                                href="#"
                                v-for="tag in report.data.event_chips"
                                :key="tag.id"
                                >{{ tag.player.name }}</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import FrontLayout from "@/Layouts/FrontLayout.vue";
import CustomeTable from "@/Components/Frontend/CustomeTable.vue";
import CountryFlag from "vue3-country-flag-icon";
import defaultAvatar from "@/default-avatar.png";
import axios from "axios";

import brokenMirror from "@/photo_templates/brokenmirror.png";
import bulletHole from "@/photo_templates/bullethole.png";
import flames from "@/photo_templates/flames.png";
import happyBirthday from "@/photo_templates/happybirthday.png";
import iceCubes from "@/photo_templates/icecubes.png";
import pocketAces from "@/photo_templates/pocketaces.png";
import sunRays from "@/photo_templates/sunrays.png";
import waterLeaves from "@/photo_templates/water-leaves.png";
import waterWaves from "@/photo_templates/water-waves.png";
import moment from "moment";
import { useEventStore } from "@/Stores/event.js";
import { onMounted, ref, watch } from "@vue/runtime-core";

const eventStore = useEventStore();

const props = defineProps({
    slug: {
        type: String,
        default: "",
    },
    report: {
        type: Object,
    },
});

const isOpen = ref(false);

const showShare = () => {
    isOpen.value = !isOpen.value;
};

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
</script>

<style scoped>
:deep(.remove-padding p) {
    padding-left: unset;
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

.text-green {
    color: #2ecc71;
}

.text-red {
    color: #e74c3c;
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

.share-post-desktop {
    display: none;
}

.share-btn-mobile {
    margin: 0;
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

    .share-post-mobile {
        display: none;
    }

    .share-post-desktop {
        display: block;
    }
}

@media (min-width: 1200px) {
    .post-content-min-height {
        min-height: 320px;
    }
}
</style>
