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
                        <div v-if="props.type !== 'payouts'">
                            <p v-if="eventDays?.length > 1">
                                <select
                                    class="form-control custom-form-control"
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
                        :currentTab="type"
                        :day="day"
                        :url="url"
                        @loadMore="loadMoreReports"
                    />
                </div>
            </div>
        </div>
        <div class="toast" :class="{ active: isActive }" @click="scrollToTop">
            <div class="toast-content">
                <i class="fas fa-info-circle info"></i>

                <div class="message">
                    <span class="text text-1">New post - click here</span>
                </div>
            </div>
            <div class="progress" :class="{ active: isActive }"></div>
        </div>
    </FrontLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import FrontLayout from "@/Layouts/FrontLayout.vue";
import ReportList from "../../Components/Frontend/Report/ReportList.vue";
import SideBar from "../../Components/Frontend/MainContent/SideBar.vue";
import TournamentList from "../../Components/Frontend/Tournament/List.vue";

import { useEventStore } from "@/Stores/event.js";
import { useTournamentStore } from "@/Stores/tournament.js";
import { onMounted, ref, watch, computed, onUpdated } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
const eventStore = useEventStore();
const tournamentStore = useTournamentStore();

const props = defineProps({
    slug: {
        type: String,
    },
    page: {
        type: String,
    },
    series: {
        type: String,
    },
    day: {
        type: String,
    },
    type: {
        type: String,
    },
    url: {
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
const isActive = ref(false);

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
    liveReport.value.push(...eventStore.liveReportList.data);
    // const newLevel = eventStore.liveReportList.data
    //     .map((data) => data.level)
    //     .toString();

    // for (const report of liveReport.value) {
    //     if (report.level === newLevel) {
    //         const index = eventStore.liveReportList.data.findIndex(
    //             (data) => data.level === report.level
    //         );
    //         const newCollection = report.collection.concat(
    //             eventStore.liveReportList.data[index].collection
    //         );
    //         report.collection = newCollection;
    //         return;
    //     }
    // }
    lastPage.value = eventStore.liveReportList.meta.last_page;
}

async function reportViewing() {
    if (props.type === null) {
        await eventStore.getLiveReport(1, selectDay.value);
        liveReport.value = eventStore.liveReportList.data;
        lastPage.value = eventStore.liveReportList.meta.last_page;
        return;
    }

    if (props.type === "chip-stack") {
        await eventStore.getChipCountsData(selectDay.value);
        chipCountsData.value = eventStore.chipCounts;
        return;
    }

    if (props.type === "whatsapp") {
        await eventStore.getWhatsappData(selectDay.value);
        whatsappData.value = eventStore.whatsapp;
        return;
    }

    if (props.type === "gallery") {
        await eventStore.getGalleryData(selectDay.value);
        galleryData.value = eventStore.galleryData;
        return;
    }

    if (props.type === "payouts") {
        await eventStore.getPayoutsData(eventData.value.slug);
        payoutsData.value = eventStore.payouts.data;
        return;
    }
}

function scrollToTop() {
    window.scroll({ top: 0, behavior: "smooth" });
    isActive.value = false;
    if (props.type !== "live-updates") {
        Inertia.visit(
            `/tours/${eventData.value.tour_slug}/${
                eventData.value.tournament_slug
            }/${eventData.value.slug}/${eventData.value.available_days[
                selectDay.value
            ]
                .replace(/[^A-Z0-9]+/gi, "-")
                .toLowerCase()}/live-updates`,
            { preserveState: true }
        );
    }
}

onMounted(async () => {
    console.log(props.day);
    console.log(props.type);
    await eventStore.getEventData(props.slug);
    if (props.day === "" || props.day === props.type) {
        selectDay.value = highestDay();
    } else {
        selectDay.value = Object.keys(eventData.value.available_days).find(
            (key) =>
                JSON.stringify(eventData.value.available_days[key]) ===
                JSON.stringify(props.day.toUpperCase())
        );
    }
    reportViewing();

    window.Echo.channel("report").listen(
        "NewReport",
        ({ eventSlug, dayid }) => {
            if (props.slug === eventSlug && selectDay.value == dayid) {
                fetchLiveReports();
                isActive.value = true;

                setTimeout(() => {
                    isActive.value = false;
                }, 5000);
            }
        }
    );
    // await tournamentStore.getList();
});

onUpdated(() => {
    reportViewing();
});

const fetchLiveReports = () => {
    loadPage.value = 1;
    lastPage.value = 1;
    reportViewing();

    if (props.type === null || props.day === "") {
        Inertia.visit(
            `/tours/${eventData.value.tour_slug}/${
                eventData.value.tournament_slug
            }/${eventData.value.slug}/${eventData.value.available_days[
                selectDay.value
            ]
                .replace(/[^A-Z0-9]+/gi, "-")
                .toLowerCase()}`,
            { preserveState: true }
        );
        return;
    }
    Inertia.visit(
        `/tours/${eventData.value.tour_slug}/${
            eventData.value.tournament_slug
        }/${eventData.value.slug}/${eventData.value.available_days[
            selectDay.value
        ]
            .replace(/[^A-Z0-9]+/gi, "-")
            .toLowerCase()}/${props.type}`,
        { preserveState: true }
    );

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
.custom-form-control {
    width: auto !important;
}

.toast {
    position: fixed;
    top: 25px;
    right: 30px;
    z-index: 1000;
    overflow: hidden;
    padding: 20px 35px 20px 25px;
    background-color: #fff;
    border-radius: 12px;
    cursor: pointer;
    box-shadow: 0 6px 20px -5px rgba(0, 0, 0, 0.5);
    transform: translateX(calc(100% + 30px));
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
}

.toast.active {
    transform: translateX(0%);
}

.toast .toast-content {
    display: flex;
    align-items: center;
}

.toast-content .info {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
}

.toast-content .message {
    display: flex;
    flex-direction: column;
    margin: 0 20px;
}

.message .text {
    font-size: 16px;
    font-weight: 400;
    color: #666666;
}

.message .text.text-1 {
    font-weight: 600;
    color: #333;
}

.toast .progress {
    position: absolute;
    bottom: -20px;
    left: 0;
    width: 100%;
    height: 3px;
}

.toast .progress:before {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background-color: #f44336;
}

.progress.active:before {
    animation: progress 5s linear forwards;
}

@keyframes progress {
    100% {
        right: 100%;
    }
}
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
