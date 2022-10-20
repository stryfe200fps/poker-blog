<template>
    <Head>
        <title>This is a dynamic inertia</title>
        <meta property="og:image" name="test" />
        <meta property="og:image" name="test" />
    </Head>

    <FrontLayout title="kurik">
        <div class="block-content">
            <div class="title-section">
                <h1><span>Live reporting</span></h1>
            </div>
            <div class="single-post-box">
                <!-- <EventTabs :tournament-list="tournamentStore.list" :list="eventStore.list"></EventTabs> -->
                <TournamentList
                    :live="liveEventCollection"
                    :past="pastEventCollection"
                    :upcoming="upcomingEventCollection"
                    :currentTab="page"
                />
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>
import { Head, InertiaLink } from "@inertiajs/inertia-vue3";

import FrontLayout from "@/Layouts/FrontLayout.vue";
import ReportList from "../../Components/Frontend/Report/ReportList.vue";
import SideBar from "../../Components/Frontend/MainContent/SideBar.vue";
import TournamentList from "../../Components/Frontend/Tournament/List.vue";

import { useTournamentStore } from "@/Stores/tournament.js";
import { onMounted, onUpdated, ref, watch } from "@vue/runtime-core";

const props = defineProps({
    page: {
        type: String,
    },
});

const tournamentStore = useTournamentStore();

const list = ref([]);
const liveEventCollection = ref([]);
const pastEventCollection = ref([]);
const upcomingEventCollection = ref([]);
const pathname = ref(window.location.pathname.split("/")[2]);

async function eventViewing(pathname) {
    if (pathname === undefined || pathname === "live") {
        await tournamentStore.getList("live");
        liveEventCollection.value = tournamentStore.list;
        return;
    }

    if (pathname === "past") {
        await tournamentStore.getList("end");
        pastEventCollection.value = tournamentStore.list;
        return;
    }

    if (pathname === "upcoming") {
        await tournamentStore.getList("tba");
        upcomingEventCollection.value = tournamentStore.list;
        return;
    }
}

onMounted(() => {
    // await tournamentStore.getList();
    eventViewing(pathname.value);
});

onUpdated(() => {
    pathname.value = window.location.pathname.split("/")[2];
    eventViewing(pathname.value);
});

// watch(
//     () => tournamentStore.list.data,
//     function () {
//         list.value = tournamentStore.list;
//     }
// );
</script>
