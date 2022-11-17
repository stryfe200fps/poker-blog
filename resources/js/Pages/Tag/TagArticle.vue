<template>
    <Head>
        <title>Tag: {{ slug.charAt(0).toUpperCase() + slug.slice(1) }}</title>
    </Head>
    <FrontLayout>
        <div class="block-content">
            <div class="grid-box">
                <div class="title-section">
                    <h1>
                        <span>TAG: {{ slug }}</span>
                    </h1>
                </div>
                <div class="row">
                    <div
                        class="col-md-4"
                        style="margin-bottom: 30px"
                        v-for="(tag, index) in tags"
                        :key="index"
                    >
                        <div
                            class="item news-post image-post3"
                            style="cursor: pointer"
                            @click="showArticle(tag.date, tag.slug)"
                        >
                            <img
                                v-if="tag.image_set"
                                :src="tag.image_set.md_image"
                                :alt="tag.image_set.md_image"
                            />
                            <img v-else :src="defaultImg" :alt="defaultImg" />
                            <div class="hover-box">
                                <h2>
                                    <Link
                                        :href="`/news/${moment(
                                            new Date(tag.date)
                                        ).format('YYYY')}/${moment(
                                            new Date(tag.date)
                                        ).format('MM')}/${tag.slug}`"
                                        v-html="tag.title"
                                    ></Link>
                                </h2>
                                <ul class="post-tags">
                                    <li>
                                        <i class="fa fa-clock-o"></i
                                        >{{ tag.date }}
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
import FrontLayout from "@/Layouts/FrontLayout.vue";
import defaultImg from "/public/default-img.png";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { useTagStore } from "@/Stores/tag.js";
import { onMounted, ref, watch } from "@vue/runtime-core";
import moment from "moment";

const props = defineProps({
    slug: String,
});

const tagStore = useTagStore();
const tags = ref(null);

function showArticle(date, slug) {
    Inertia.visit(
        `/news/${moment(new Date(date)).format("YYYY")}/${moment(
            new Date(date)
        ).format("MM")}/${slug}`
    );
}

onMounted(async () => {
    await tagStore.getTagLists(props.slug);
});

watch(
    () => tagStore.tagLists,
    function () {
        tags.value = tagStore.tagLists.data;
    }
);
</script>
