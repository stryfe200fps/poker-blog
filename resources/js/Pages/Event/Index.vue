<template>
    <FrontLayout title="Event">
        <div v-if="eventData">
            <div class="block-content" v-if="1">
                <div class="title-section">
                    <h1>
                        <span>{{ eventData.tournament }}</span>
                    </h1>
                </div>
                <div class="title-section hide-underline">
                    <div
                        style="
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        "
                    >
                        <h1>
                            <span class="text-capitalize">{{
                                eventData.title
                            }}</span>
                        </h1>
                        <div v-if="pathname !== 'payouts'">
                            <p v-if="eventDays?.length > 1">
                                <select
                                    class="form-control"
                                    v-model="selectDay"
                                    @change="fetchLiveReports"
                                >
                                    <option
                                        class="text-start text-uppercase"
                                        v-for="(data, index) in eventDays"
                                        :key="index"
                                        :value="data"
                                        :checked="data == selectDay"
                                    >
                                        Day {{ eventData.available_days[data] }}
                                    </option>
                                </select>
                            </p>
                            <p
                                v-else
                                v-for="(data, index) in eventDays"
                                :key="index"
                            >
                                Day:
                                <span class="text-uppercase">
                                    {{ eventData.available_days[data] }}</span
                                >
                            </p>
                        </div>
                    </div>
                </div>
                <div class="single-post-box">
                    <ReportList
                        :event="eventData"
                        :reports="liveReport"
                        :chipCounts="chipCountsData"
                        :whatsapp="whatsappData"
                        :gallery="galleryData"
                        :payouts="payoutsData"
                        @loadMore="loadMoreReports"
                        @showNewReport="fetchLiveReports"
                        :currentTab="page"
                    />
                </div>
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

import { useEventStore } from "@/Stores/event.js";
import { useTournamentStore } from "@/Stores/tournament.js";
import { onMounted, ref, watch, computed, onUpdated } from "@vue/runtime-core";

const eventStore = useEventStore();
const tournamentStore = useTournamentStore();

const props = defineProps({
    slug: {
        type: String,
    },
    page: {
        type: String,
    },
    day: {
        type: String,
    },
});

const eventData = ref([]);
const selectDay = ref(null);
const liveReport = ref([]);
const chipCountsData = ref([]);
const whatsappData = ref([]);
const galleryData = ref([]);
const payoutsData = ref([]);
const loadPage = ref(1);
const lastPage = ref(1);
const pathname = ref(window.location.pathname.split("/")[3]);

const eventDays = computed(() => {
    return Object.keys(eventData?.value?.available_days ?? {});
});

const highestDay = () => {
    let { available_days } = eventData.value;
    let days = Object.keys(available_days);
    return days[days.length - 1];
};

async function loadMoreReports() {
    if (loadPage.value >= lastPage.value) return;
    loadPage.value++;

    await eventStore.getLiveReport(loadPage.value, selectDay.value);

    const newLevel = eventStore.liveReportList.data
        .map((data) => data.level)
        .toString();

    for (const report of liveReport.value) {
        if (report.level === newLevel) {
            const index = eventStore.liveReportList.data.findIndex(
                (data) => data.level === report.level
            );
            const newCollection = report.collection.concat(
                eventStore.liveReportList.data[index].collection
            );
            report.collection = newCollection;
            return;
        }
    }
    lastPage.value = eventStore.liveReportList.meta.last_page;
}

async function reportViewing(pathname) {
    if (pathname === undefined) {
        await eventStore.getLiveReport(1, selectDay.value);
        liveReport.value = eventStore.liveReportList.data;
        lastPage.value = eventStore.liveReportList.meta.last_page;
        return;
    }

    if (pathname === "chip-stack") {
        await eventStore.getChipCountsData(selectDay.value);
        chipCountsData.value = eventStore.chipCounts;
        return;
    }

    if (pathname === "whatsapp") {
        await eventStore.getWhatsappData(selectDay.value);
        whatsappData.value = eventStore.whatsapp;
        return;
    }

    if (pathname === "gallery") {
        await eventStore.getGalleryData(selectDay.value);
        galleryData.value = eventStore.galleryData;
        return;
    }

    if (pathname === "payouts") {
        await eventStore.getPayoutsData(eventData.value.slug);
        payoutsData.value = eventStore.payouts.data;
        return;
    }
}

onMounted(async () => {
    await eventStore.getEventData(props.slug);
    selectDay.value = highestDay();
    reportViewing(pathname.value);
    // await tournamentStore.getList();
});

onUpdated(() => {
    pathname.value = window.location.pathname.split("/")[3];
    reportViewing(pathname.value);
});

const fetchLiveReports = async () => {
    loadPage.value = 1;
    lastPage.value = 1;
    reportViewing(pathname.value);
    // await eventStore.getLiveReport(1, selectDay.value);
    // liveReport.value = eventStore.liveReportList.data;
    // lastPage.value = eventStore.liveReportList.meta.last_page;
    // await eventStore.getGalleryData(selectDay.value);
    // galleryData.value = eventStore.galleryData;
};

// const fetchPage = async () => {
//     await eventStore.fetchWithPaginate(props.id,days.value)
// }

watch(
    () => eventStore.eventData.data,
    function () {
        eventData.value = eventStore.eventData.data;
    }
);

// watch(
//     () => eventStore.liveReportList,
//     function () {
//         liveReport.value = eventStore.liveReportList.data;
//     }
// );
</script>

<style scoped>
.text-secondary {
    color: #2d3436 !important;
}

.single-post-box > .post-content p {
    padding: unset;
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
    margin-left: 10px;
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
