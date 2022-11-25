<<<<<<< HEAD
<template>
    <MainBar
        :liveEvents="liveEvents"
        :mainBanner="mainBanner"
        :articleList="articleList"
        :ytLinks="youtubeLinks"
        :isLoading="isLoading"
    />
</template>

<script setup>
import { useEventStore } from "@/Stores/event.js";
import { useBannerStore } from "@/Stores/banner.js";
import { useArticleStore } from "@/Stores/article.js";
import { useYoutubeStore } from "@/Stores/youtube.js";
import { onMounted, ref } from "@vue/runtime-core";

=======
<script setup>
import { useEventStore } from "@/Stores/event.js";
import { useBannerStore } from "@/Stores/banner.js";
import { useArticleStore } from "@/Stores/article.js";
import { onMounted, ref } from "@vue/runtime-core";

import FrontLayout from "../Layouts/FrontLayout.vue";
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
import MainBar from "../Components/Frontend/MainContent/MainBar.vue";

const eventStore = useEventStore();
const liveEvents = ref([]);
const bannerStore = useBannerStore();
const mainBanner = ref([]);
const articleStore = useArticleStore();
const articleList = ref([]);
<<<<<<< HEAD
const youtubeStore = useYoutubeStore();
const youtubeLinks = ref([]);
=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
const isLoading = ref(true);

onMounted(async () => {
    await eventStore.getMainEvents();
    liveEvents.value = eventStore.mainEvents.data;
    await bannerStore.getBanners();
    mainBanner.value = bannerStore.getMainBanner();
    await articleStore.getList();
    articleList.value = articleStore.list.data;
<<<<<<< HEAD
    await youtubeStore.getYoutubeLinks();
    youtubeLinks.value = youtubeStore.youtubeLinks;

    if (
        articleList.value &&
        youtubeLinks.value &&
        (liveEvents.value || mainBanner.value)
    ) {
=======

    if (articleList.value && (liveEvents.value || mainBanner.value)) {
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        isLoading.value = false;
    }
});
</script>
<<<<<<< HEAD
=======

<template>
    <FrontLayout>
        <MainBar
            :liveEvents="liveEvents"
            :mainBanner="mainBanner"
            :articleList="articleList"
            :isLoading="isLoading"
        />
    </FrontLayout>
</template>
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
