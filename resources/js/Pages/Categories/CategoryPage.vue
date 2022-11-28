<template>
    <Head>
        <title>
            {{ page_title.charAt(0).toUpperCase() + page_title.slice(1) }} |
            LifeOfPoker
        </title>
    </Head>
    <div class="block-content">
        <div class="grid-box">
            <div class="title-section">
                <div
                    style="
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    "
                >
                    <h1 style="margin: 20px 0 -1px 0">
                        <span>{{ page_title }}</span>
                    </h1>
                    <select
                        class="form-control"
                        v-model="selectCategory"
                        @change="changeCategory"
                        style="width: auto !important"
                    >
                        <option
                            v-for="(category, index) in categories"
                            :key="index"
                            :value="category.slug"
                            :checked="category.title == selectCategory"
                            :disabled="category.title == 'Categories'"
                        >
                            {{ category.title }}
                        </option>
                    </select>
                </div>
            </div>
            <div v-if="isLoading">
                <LoadingBar />
            </div>
            <div v-else>
                <div v-if="articleCategories?.length">
                    <div class="grid">
                        <div
                            v-for="(category, index) in articleCategories"
                            :key="index"
                        >
                            <div
                                class="news-post standard-post2"
                                style="
                                    display: flex;
                                    flex-direction: column;
                                    height: 100%;
                                    cursor: pointer;
                                "
                                @click="
                                    showArticle(category.date, category.slug)
                                "
                            >
                                <div class="post-gallery">
                                    <img
                                        v-if="category.image_set"
                                        :src="category.image_set.md_image"
                                        :alt="category.image_set.md_image"
                                    />
                                    <img
                                        v-else
                                        :src="defaultImg"
                                        :alt="defaultImg"
                                    />
                                    <Link
                                        class="category-post food"
                                        v-if="category.categories.length"
                                        :href="`/news/${category.categories[0]?.slug}`"
                                        @click.stop
                                        >{{
                                            pathname === undefined
                                                ? category.categories[0]?.title
                                                : category.categories[
                                                      category.categories.findIndex(
                                                          (category) =>
                                                              category.title
                                                                  .charAt(0)
                                                                  .toUpperCase() +
                                                                  category.title
                                                                      .slice(1)
                                                                      .toLowerCase() ===
                                                              page_title
                                                      )
                                                  ]?.title
                                        }}</Link
                                    >
                                </div>
                                <div class="post-title" style="flex-grow: 1">
                                    <h2>
                                        <Link
                                            :href="`/news/${moment(
                                                new Date(category.date)
                                            ).format('YYYY')}/${moment(
                                                new Date(category.date)
                                            ).format('MM')}/${category.slug}`"
                                            v-html="category.title"
                                        ></Link>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div
                            v-if="articleCategories?.length"
                            v-observe-visibility="handleScrolledToBottom"
                        ></div>
                    </div>
                </div>
                <div v-else>
                    <h4 class="text-capitalize">
                        No {{ page_title }} available
                    </h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import LoadingBar from "@/Components/LoadingBar.vue";
import defaultImg from "/public/default-img.png";

import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useArticleCategoryStore } from "@/Stores/articleCategory.js";
import { onMounted, ref, watch } from "@vue/runtime-core";
import moment from "moment";

const props = defineProps({
    page: {
        type: String,
    },

    page_title: {
        type: String,
    },
});

const articleCategoryStore = useArticleCategoryStore();
const articleCategories = ref(null);
const categories = ref([{ title: "Categories", slug: "categories" }]);
const currentPage = ref(1);
const lastPage = ref(1);
const selectCategory = ref("categories");
const pathname = ref(window.location.pathname.split("/")[2]);
const isLoading = ref(true);

async function handleScrolledToBottom(isVisible) {
    if (!isVisible) return;

    currentPage.value++;

    if (currentPage.value > lastPage.value) return;

    await articleCategoryStore.getArticleCategoryLists(
        pathname.value,
        currentPage.value
    );
    lastPage.value = articleCategoryStore.articleCategoryLists.meta.last_page;
}

function changeCategory() {
    Inertia.visit(`/news/${selectCategory.value}`);
}

function showArticle(date, slug) {
    Inertia.visit(
        `/news/${moment(new Date(date)).format("YYYY")}/${moment(
            new Date(date)
        ).format("MM")}/${slug}`
    );
}

onMounted(async () => {
    await articleCategoryStore.getCategoryLists();
    categories.value.push(...articleCategoryStore.categoryLists.data);
    await articleCategoryStore.getArticleCategoryLists(pathname.value, 1);
    lastPage.value = articleCategoryStore.articleCategoryLists.meta.last_page;

    if (articleCategories.value) isLoading.value = false;
});

watch(
    () => articleCategoryStore.articleCategoryLists,
    function () {
        if (!articleCategories.value) {
            articleCategories.value =
                articleCategoryStore.articleCategoryLists.data;
            return;
        }
        articleCategories.value.push(
            ...articleCategoryStore.articleCategoryLists.data
        );
    }
);
</script>

<style scoped>
.post-gallery {
    float: none !important;
    margin-right: 0 !important;
    margin-left: 0 !important;
}

.post-title {
    padding: 0 !important;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
    gap: 30px;
}
</style>
