<template>
    <Head>
        <title>Live Reporting</title>
    </Head>
    <div class="block-content">
        <div class="title-section">
            <h1><span>Live reporting</span></h1>
        </div>
        <div class="single-post-box">
            <TournamentList
                :live="liveEventCollection"
                :past="pastEventCollection"
                :currentTab="page"
                :isLoading="isLoading"
                @loadMore="loadMoreReports"
            />
        </div>
    </div>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { useTournamentStore } from "@/Stores/tournament.js";
import { onMounted, ref } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";

import TournamentList from "../../Components/Frontend/Tournament/List.vue";

import TournamentList from "../../Components/Frontend/Tournament/List.vue";

const props = defineProps({
    page: {
        type: String,
    },
});

const tournamentStore = useTournamentStore();
const liveEventCollection = ref([]);
const pastEventCollection = ref([]);
const pathname = ref("");
const loadPage = ref(1);
const lastPage = ref(1);
const isLoading = ref(true);

async function loadMoreReports() {
    if (loadPage.value >= lastPage.value) return;
    loadPage.value++;

    if (pathname.value === undefined || pathname.value === "live") {
        await tournamentStore.getList(loadPage.value, "upcoming");
        liveEventCollection.value.push(...tournamentStore.upcoming.data);
        lastPage.value = tournamentStore.upcoming.meta.last_page;
        return;
    }

    if (pathname.value === "past") {
        await tournamentStore.getList(loadPage.value, "end");
        pastEventCollection.value.push(...tournamentStore.list.data);
        lastPage.value = tournamentStore.list.meta.last_page;
        return;
    }
}

async function eventViewing(pathname) {
    loadPage.value = 1;

    if (pathname === undefined || pathname === "live") {
        if (!Object.entries(liveEventCollection.value).length) {
            await tournamentStore.getList(1, "live");
            liveEventCollection.value = tournamentStore.list.data;
            await tournamentStore.getList(1, "upcoming");
            liveEventCollection.value.push(...tournamentStore.upcoming.data);
            lastPage.value = tournamentStore.upcoming.meta?.last_page;
            isLoading.value = false;
        } else {
            lastPage.value = tournamentStore.upcoming.meta?.last_page;
            isLoading.value = false;
        }
        return;
    }

    if (pathname === "past") {
        if (!Object.entries(pastEventCollection.value).length) {
            await tournamentStore.getList(1, "end");
            pastEventCollection.value = tournamentStore.list.data;
            lastPage.value = tournamentStore.list.meta?.last_page;
            isLoading.value = false;
        } else {
            lastPage.value = tournamentStore.list.meta?.last_page;
            isLoading.value = false;
        }
        return;
    }
}

onMounted(() => {
    Inertia.on("navigate", (event) => {
        isLoading.value = true;
        eventViewing(event.detail.page.props.page);
        pathname.value = event.detail.page.props.page;
    });
});
</script>
