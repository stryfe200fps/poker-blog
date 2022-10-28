<template>
    <FrontLayout title="">
        <Head>
            <title>{{ article.title }}</title>
        </Head>
        <!-- {{ getArticle(slug) }} -->
        <div class="block-content">
            <label
                id="table-of-contents"
                class="table-contents"
                v-if="article.content?.length > 1"
            >
                <div @click="isPull = !isPull" class="table-header">
                    Table of Contents
                </div>
                <ul class="table-menu" :class="{ pull: isPull }">
                    <li
                        v-for="(content, index) in article.content"
                        :key="index"
                    >
                        <a
                            :href="'#content' + index"
                            v-html="content.title"
                            @click="isPull = false"
                        ></a>
                    </li>
                </ul>
            </label>
            <div class="title-section">
                <h1 class="text-primary">
                    <span style="cursor: pointer" @click="goBack"
                        ><i class="fa fa-chevron-left" aria-hidden="true"></i>
                        Back</span
                    >
                </h1>
            </div>
            <div class="single-post-box">
                <div class="title-post">
                    <h1>
                        <h1>{{ article.title }}</h1>
                    </h1>
                    <div
                        style="
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        "
                    >
                        <div>
                            <ul class="post-tags">
                                <li>
                                    <i class="fa fa-clock-o"></i
                                    >{{ article.date }}
                                </li>
                                <li>
                                    <i class="fa fa-user"></i>by
                                    <a href="#">{{ article.author?.name }} </a>
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
                                                :href="`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
                                                    url
                                                )}&amp;src=sdkpreparse`"
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
                                            class="btn custom-btn"
                                            style="
                                                margin-right: 0;
                                                background-color: #18a3dd;
                                            "
                                        >
                                            <a
                                                target="_blank"
                                                :href="`https://twitter.com/intent/tweet?text=${encodeURIComponent(
                                                    url
                                                )}`"
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
                                            class="btn custom-btn"
                                            style="background-color: #25d366"
                                        >
                                            <a
                                                target="_blank"
                                                :href="`https://api.whatsapp.com/send?text=%0a${url}`"
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
                                        v-click-outside-element="onClickOutside"
                                        class="btn btn-default share-btn-mobile"
                                    >
                                        <i class="fa fa-share-alt"></i
                                        ><span class="text-uppercase"
                                            >Share</span
                                        >
                                    </li>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div v-if="article.main_image" class="post-gallery">
                    <img :src="article.main_image" :alt="article.main_image" />
                    <span class="image-caption">{{ article.caption }}</span>
                </div>
                <div v-if="article.content?.length > 1">
                    <h4 class="text-uppercase">Table of Contents</h4>
                    <ul style="padding-inline-start: 20px; font-size: 16px">
                        <li
                            v-for="(content, index) in article.content"
                            :key="index"
                            style="margin: 10px 0; list-style: square"
                        >
                            <a
                                class="text-primary"
                                :href="'#content' + index"
                                @click="isPull = false"
                                v-html="content.title"
                            ></a>
                        </li>
                    </ul>
                </div>
                <div
                    v-for="(content, index) in article.content"
                    :key="index"
                    class="post-content"
                >
                    <h3 style="margin-bottom: 20px" v-html="content.title"></h3>
                    <div v-html="content.body"></div>
                </div>
                <div class="post-tags-box" v-if="article.tags?.length">
                    <ul class="tags-box">
                        <li><i class="fa fa-tags"></i><span>Tags:</span></li>
                        <li v-for="tags in article.tags" :key="tags.id">
                            <Link :href="'/tag/articles/' + tags.slug">{{
                                tags.title
                            }}</Link>
                        </li>
                    </ul>
                </div>
                <div
                    class="title-section"
                    style="margin-top: 50px"
                    v-if="related?.length"
                >
                    <h1><span>Related news</span></h1>
                </div>
                <div class="row">
                    <div
                        class="col-xs-12 col-md-4"
                        style="margin-bottom: 30px"
                        v-for="relate in related"
                        :key="relate.id"
                    >
                        <div class="item news-post image-post3">
                            <img
                                :src="relate.main_image"
                                alt=""
                                v-if="relate.main_image.length"
                            />
                            <img v-else :src="defaultImg" alt="" />
                            <div class="hover-box">
                                <h2>
                                    <Link
                                        :href="`/news/${moment(
                                            new Date(relate.date)
                                        ).format('YYYY')}/${moment(
                                            new Date(relate.date)
                                        ).format('MM')}/${relate.slug}`"
                                        >{{ relate.title }}
                                    </Link>
                                </h2>
                                <ul class="post-tags">
                                    <li>
                                        <i class="fa fa-clock-o"></i
                                        >{{ relate.date }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import FrontLayout from "@/Layouts/FrontLayout.vue";
import ReportList from "../../Components/Frontend/Report/ReportList.vue";
import SideBar from "../../Components/Frontend/MainContent/SideBar.vue";
import TournamentList from "../../Components/Frontend/Tournament/List.vue";

import { useArticleStore } from "@/Stores/article.js";
import { onBeforeUnmount, onMounted, ref, watch } from "@vue/runtime-core";
import defaultImg from "/public/default-img.png";
import moment from "moment";
const articleStore = useArticleStore();

const props = defineProps({
    slug: {
        type: String,
        default: "",
    },
});

const article = ref([]);
const related = ref(null);

const isOpen = ref(false);
const isPull = ref(false);
const url = ref(window.location.href);

const showShare = () => {
    isOpen.value = !isOpen.value;
};

function goBack() {
    history.back();
    return false;
}

function onClickOutside(event) {
    if (event.target.localName !== "a") {
        isOpen.value = false;
        return;
    }
}

function onScrollContents() {
    const tableOfContents = document.querySelector("#table-of-contents");
    if (tableOfContents) {
        if (window.scrollY > 200) {
            tableOfContents.classList.add("active");
        } else {
            tableOfContents.classList.remove("active");
        }

        // adding scroll-padding-top
        document.documentElement.style.setProperty(
            "--scroll-padding",
            tableOfContents.offsetHeight + 80 + "px"
        );
    }
}

onMounted(async () => {
    await articleStore.getSingleArticle(props.slug);
    await articleStore.getRelatedNews(props.slug);
    window.addEventListener("scroll", onScrollContents);
});

onBeforeUnmount(() => {
    window.removeEventListener("scroll", onScrollContents);
});

watch(
    () => articleStore.singleArticle,
    function () {
        article.value = articleStore.singleArticle.data;
    }
);
watch(
    () => articleStore.related,
    function () {
        related.value = articleStore.related.data;
    }
);
</script>

<style>
:deep(.remove-padding p) {
    padding-left: unset;
}

.content table {
    width: 100%;
    margin-bottom: 10px;
    border: 1px solid #95a5a662;
}

.content table tr td {
    padding: 5px 10px;
    font-family: Lato, sans-serif;
    font-size: 14px;
    background-color: #fbfbfb;
}

.post-gallery {
    float: none !important;
    margin-right: 0 !important;
    margin-left: 0 !important;
}

.content p {
    padding-left: 0 !important;
}

ul.post-tags {
    margin-left: 2px;
}

.single-post-box .post-tags-box {
    margin-bottom: unset;
    border-bottom: 1px solid #d3d3d3;
    padding: 0 20px;
}

.single-post-box .post-tags-box ul.tags-box li {
    margin-right: 8px;
    margin-bottom: 8px;
}

.text-secondary {
    color: #2d3436 !important;
}

.single-post-box .share-post-box ul.share-box li a {
    padding: 4px 16px;
    margin-left: 5px;
    margin-bottom: 5px;
}

.margin-top {
    margin-top: 20px;
}

.facebook {
    background-color: unset;
    /* margin-left: 10px; */
}
.twitter {
    background-color: unset;
}
.whatsapp {
    background-color: unset;
}

.each-post {
    border-top: 1px solid #d3d3d3;
    border-bottom: 1px solid #d3d3d3;
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

.custom-btn {
    padding: 0;
}

.custom-btn a {
    padding: 6px 12px;
}

.table-contents {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    left: 0;
    display: none;
    width: 100%;
    margin-bottom: 0;
    font-family: "Lato", sans-serif;
    font-size: 18px;
    font-weight: 400;
    background-color: #2d3436;
    border-bottom: 1px solid #222;
    color: #fff;
    user-select: none;
}

.table-contents.active {
    display: inline-block;
}

.table-header {
    display: inline-block;
    width: 100%;
    padding: 15px 30px 15px 20px;
    white-space: nowrap;
    cursor: pointer;
}

.table-header:after {
    content: "";
    position: absolute;
    top: 50%;
    right: 10px;
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid #fff;
    transform: translateY(-50%);
}

.table-menu {
    position: absolute;
    top: 100%;
    z-index: 1;
    right: 0;
    display: none;
    width: 100%;
    margin: 2px 0 0 0;
    padding: 0;
    font-family: "Lato", sans-serif;
    text-align: start;
    list-style-type: none;
    background-color: #2d3436;
    color: #fff;
    box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.1);
}

.table-menu.pull {
    display: block;
}

.table-menu li {
    padding: 10px 20px;
    border-bottom: 1px solid #fff;
    cursor: pointer;
    white-space: nowrap;
}

.table-menu li:hover {
    background-color: #ccc;
}

.table-menu li a {
    display: block;
    width: 100%;
    text-decoration: none;
    color: #fff;
}

/* ul.post-tags li .twitter, 
ul.post-tags li .facebook, 
ul.post-tags li .whatsapp {
   font-size: 18px;
} */

@media (min-width: 768px) {
    .post-content-min-height {
        min-height: 200px;
    }
}

@media (min-width: 992px) {
    .post-content-min-height {
        min-height: 250px;
    }
}

@media (min-width: 1200px) {
    .post-content-min-height {
        min-height: 300px;
    }
}
</style>
