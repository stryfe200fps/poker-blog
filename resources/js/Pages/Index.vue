<script setup>
import { useEventStore } from "@/Stores/event.js";
import { useBannerStore } from "@/Stores/banner.js";
import { useArticleStore } from "@/Stores/article.js";
import { onMounted, ref } from "@vue/runtime-core";

import FrontLayout from "../Layouts/FrontLayout.vue";
import MainBar from "../Components/Frontend/MainContent/MainBar.vue";

const eventStore = useEventStore();
const liveEvents = ref([]);
const bannerStore = useBannerStore();
const mainBanner = ref([]);
const articleStore = useArticleStore();
const articleList = ref([]);
const isLoading = ref(true);

onMounted(async () => {
    await eventStore.getMainEvents();
    liveEvents.value = eventStore.mainEvents.data;
    await bannerStore.getBanners();
    mainBanner.value = bannerStore.getMainBanner();
    await articleStore.getList();
    articleList.value = articleStore.list.data;

    if (articleList.value && (liveEvents.value || mainBanner.value)) {
        isLoading.value = false;
    }
});
</script>

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
