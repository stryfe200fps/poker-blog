<template>
    <FrontLayout>
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
                            <span>{{ page }}</span>
                        </h1>
                        <label class="dropdown">
                            <div class="dd-button">Categories</div>
                            <input type="checkbox" class="dd-input" id="test" />
                            <ul class="dd-menu">
                                <li
                                    v-for="category in $page['props'][
                                        'category'
                                    ]"
                                    :key="category.id"
                                    class="text-capitalize"
                                >
                                    <Link
                                        v-if="category.link !== 'news'"
                                        :href="'/news/' + category.link"
                                        >{{ category.name }}</Link
                                    >
                                    <Link v-else :href="'/' + category.link">{{
                                        category.name
                                    }}</Link>
                                </li>
                            </ul>
                        </label>
                    </div>
                </div>
                <div v-if="categories?.length">
                    <div class="grid">
                        <div
                            v-for="(category, index) in categories"
                            :key="index"
                        >
                            <div
                                class="news-post standard-post2"
                                style="
                                    display: flex;
                                    flex-direction: column;
                                    height: 100%;
                                "
                            >
                                <div class="post-gallery">
                                    <img
                                        v-if="category.thumb_image"
                                        :src="category.thumb_image"
                                        :alt="category.thumb_image"
                                    />
                                    <img
                                        v-else
                                        :src="defaultImg"
                                        :alt="defaultImg"
                                    />
                                    <Link
                                        class="category-post food"
                                        :href="page"
                                        >{{ page }}</Link
                                    >
                                </div>
                                <div class="post-title" style="flex-grow: 1">
                                    <h2>
                                        <Link
                                            :href="
                                                '/article/show/' + category.slug
                                            "
                                            >{{ category.title }}</Link
                                        >
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div
                            v-if="categories?.length"
                            v-observe-visibility="handleScrolledToBottom"
                        ></div>
                    </div>
                </div>
                <div v-else>
                    <h2 class="text-capitalize">No {{ page }} available</h2>
                </div>
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>
import FrontLayout from "@/Layouts/FrontLayout.vue";
import defaultImg from "/public/default-img.png";
import { Link } from "@inertiajs/inertia-vue3";
import { useCategoryStore } from "@/Stores/category.js";
import {
    onMounted,
    ref,
    watch,
    computed,
    onBeforeMount,
} from "@vue/runtime-core";

const props = defineProps({
    page: String,
});

const categoryStore = useCategoryStore();
const categories = ref(null);
const currentPage = ref(1);
const lastPage = ref(1);

async function handleScrolledToBottom(isVisible) {
    if (!isVisible) return;

    currentPage.value++;

    if (currentPage.value > lastPage.value) return;

    await categoryStore.getCategoryLists(props.page, currentPage.value);
    lastPage.value = categoryStore.categoryLists.meta.last_page;
}

onMounted(async () => {
    await categoryStore.getCategoryLists(props.page, 1);
    lastPage.value = categoryStore.categoryLists.meta.last_page;
});

watch(
    () => categoryStore.categoryLists,
    function () {
        if (!categories.value) {
            categories.value = categoryStore.categoryLists.data;
            return;
        }
        categories.value.push(...categoryStore.categoryLists.data);
    }
);
</script>

<style scoped>
.post-gallery {
    float: none !important;
    margin-right: 0 !important;
    margin-left: 0 !important;
}

.dropdown {
    position: relative;
    display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
}

.dd-button {
    display: inline-block;
    padding: 10px 30px 10px 20px;
    white-space: nowrap;
    border: 1px solid gray;
    border-radius: 4px;
    cursor: pointer;
}

.dd-button:after {
    content: "";
    position: absolute;
    top: 50%;
    right: 10px;
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid #222;
    transform: translateY(-50%);
}

.dd-input {
    display: none;
}

.dd-menu {
    position: absolute;
    top: 100%;
    z-index: 1;
    right: 0;
    margin: 2px 0 0 0;
    padding: 0;
    text-align: start;
    list-style-type: none;
    background-color: #ffffff;
    color: #222;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.1);
}

.dd-input + .dd-menu {
    display: none;
}

.dd-input:checked + .dd-menu {
    display: block;
}

.dd-menu li {
    padding: 10px 20px;
    cursor: pointer;
    white-space: nowrap;
}

.dd-menu li:hover {
    background-color: #f6f6f6;
}

.dd-menu li a {
    text-decoration: none;
    color: #222;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
    gap: 30px;
}
</style>
