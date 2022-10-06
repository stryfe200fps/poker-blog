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
                <TournamentList :tournamentList="list" />
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

import { useTournamentStore } from "@/stores/tournament.js";
import { onMounted, ref, watch } from "@vue/runtime-core";

const tournamentStore = useTournamentStore();

const list = ref([]);

onMounted(async () => {
    await tournamentStore.getList();
});

watch(
    () => tournamentStore.list.data,
    function () {
        list.value = tournamentStore.list;
    }
);
</script>
