<template>
    <div v-if="eventData">
        <div class="block-content">
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
                    <div :class="type !== 'payouts' ? 'visible' : 'hide'">
                        <p
                            v-if="
                                eventData?.available_day_with_reports?.length >
                                1
                            "
                        >
                            <select
                                class="form-control custom-form-control"
                                v-model="selectDay"
                                @change="fetchLiveReports(true)"
                            >
                                <option
                                    class="text-start text-uppercase"
                                    v-for="(
                                        data, index
                                    ) in eventData?.available_day_with_reports"
                                    :key="index"
                                    :value="data.id"
                                    :checked="data.id == selectDay"
                                >
                                    Day
                                    {{ data.name }}
                                </option>
                            </select>
                        </p>
                        <p
                            v-else
                            v-for="(
                                data, index
                            ) in eventData?.available_day_with_reports"
                            :key="index"
                        >
                            Day:
                            <span class="text-uppercase">{{ data.name }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="single-post-box">
                <ReportList
                    :event="eventData"
                    :reports="liveReport"
                    :chipCounts="chipCountsData"
                    :whatsappContent="whatsappContent"
                    :whatsapp="whatsappData"
                    :gallery="galleryData"
                    :payouts="payoutsData"
                    :currentTab="type"
                    :day="day"
                    :url="url"
                    :reportingBanner="reportingBanner"
                    :isLoading="isLoading"
                    :hasNewReport="hasNewReport"
                    @loadMore="loadMoreReports"
                />
            </div>
        </div>
    </div>
    <AlertMessage :isActive="isActive" @scrollToTop="scrollToTop" />
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { useEventStore } from "@/Stores/event.js";
import { useBannerStore } from "@/Stores/banner.js";
import { onMounted, ref, computed, watch } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";

import ReportList from "../../Components/Frontend/Report/ReportList.vue";
import AlertMessage from "../../Components/Frontend/Report/AlertMessage.vue";

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

const eventStore = useEventStore();
const bannerStore = useBannerStore();
const eventData = ref([]);
const selectDay = ref(null);
const liveReport = ref([]);
const chipCountsData = ref([]);
const whatsappData = ref([]);
const whatsappContent = ref([]);
const galleryData = ref([]);
const payoutsData = ref([]);
const loadPage = ref(1);
const lastPage = ref(1);
const isActive = ref(false);
const reportingBanner = ref([]);
const daySlug = ref(window.location.pathname.split("/")[5]);
const isLoading = ref(true);
const hasNewReport = ref(false);

const highestDay = computed(() => {
    let { available_day_with_reports } = eventData.value;
    let days = available_day_with_reports.map((day) => day.id);
    return days[days.length - 1];
});

async function loadMoreReports() {
    if (loadPage.value >= lastPage.value) return;
    loadPage.value++;

    await eventStore.getLiveReport(loadPage.value, selectDay.value);
    liveReport.value.push(...eventStore.liveReportList.data);
    // eventStore.liveReportList.data.forEach((data) => {
    //     const list = liveReport.value.filter((val) => val.level === data.level);

    //     if (list.length) {
    //         const index = liveReport.value.indexOf(list[0]);

    //         liveReport.value[index].collection = liveReport.value[
    //             index
    //         ].collection.concat(data.collection);
    //     } else {
    //         liveReport.value.push(data);
    //     }
    // });
    lastPage.value = eventStore.liveReportList.meta.last_page;
}

async function reportViewing(type) {
    if (type === null) {
        if (!Object.entries(liveReport.value).length || hasNewReport.value) {
            await eventStore.getLiveReport(1, selectDay.value);
            liveReport.value = eventStore.liveReportList.data;
            lastPage.value = eventStore.liveReportList.meta.last_page;
            reportingBanner.value = bannerStore.getReportingBanner();
        }
        isLoading.value = false;
        return;
    }

    if (type === "chip-stack") {
        if (!Object.entries(chipCountsData.value).length) {
            await eventStore.getChipCountsData(selectDay.value);
            chipCountsData.value = eventStore.chipCounts.data;
        }
        isLoading.value = false;
        return;
    }

    if (type === "whatsapp") {
        if (!Object.entries(whatsappData.value).length) {
            await eventStore.getWhatsappData(selectDay.value);
            whatsappData.value = eventStore.whatsapp.data;
            await eventStore.getWhatsappContent();
            whatsappContent.value = eventStore.whatsappContent;
        }
        isLoading.value = false;
        return;
    }

    if (type === "gallery") {
        if (!Object.entries(galleryData.value).length) {
            await eventStore.getGalleryData(selectDay.value);
            galleryData.value = eventStore.galleryData.data;
        }
        isLoading.value = false;
        return;
    }

    if (type === "payouts") {
        if (!Object.entries(payoutsData.value).length) {
            await eventStore.getPayoutsData(eventData.value.slug);
            payoutsData.value = eventStore.payouts.data;
        }
        isLoading.value = false;
        return;
    }
}

function fetchLiveReports(value) {
    isLoading.value = value;
    loadPage.value = 1;
    lastPage.value = 1;

    if (!hasNewReport.value) {
        liveReport.value = [];
        chipCountsData.value = [];
        whatsappData.value = [];
        galleryData.value = [];
    }

    const { name } = eventData.value.available_day_with_reports.find(
        ({ id }) => id == selectDay.value
    );

    if (props.type === null) {
        Inertia.visit(
            `/tours/${eventData.value.tour_slug}/${
                eventData.value.tournament_slug
            }/${eventData.value.slug}/${name
                .replace(/[^A-Z0-9]+/gi, "-")
                .toLowerCase()}`,
            { preserveState: true }
        );
        return;
    }
    Inertia.visit(
        `/tours/${eventData.value.tour_slug}/${
            eventData.value.tournament_slug
        }/${eventData.value.slug}/${name
            .replace(/[^A-Z0-9]+/gi, "-")
            .toLowerCase()}/${props.type}`,
        { preserveState: true }
    );
}

function scrollToTop() {
    hasNewReport.value = false;
    isActive.value = false;
    const { name } = eventData.value.available_day_with_reports.find(
        ({ id }) => id == selectDay.value
    );
    if (props.type) {
        Inertia.visit(
            `/tours/${eventData.value.tour_slug}/${
                eventData.value.tournament_slug
            }/${eventData.value.slug}/${name
                .replace(/[^A-Z0-9]+/gi, "-")
                .toLowerCase()}`,
            { preserveState: true }
        );
    } else {
        window.scroll({ top: 0, behavior: "smooth" });
    }
}

onMounted(async () => {
    await eventStore.getEventData(props.slug);

    if (daySlug.value === undefined || daySlug.value === props.type) {
        selectDay.value = highestDay.value;
    } else {
        const { id } = eventData.value.available_day_with_reports.find(
            ({ name }) =>
                JSON.stringify(
                    name.replace(/[^A-Z0-9]+/gi, "-").toLowerCase()
                ) ===
                JSON.stringify(
                    props.day.replace(/[^A-Z0-9]+/gi, "-").toLowerCase()
                )
        );
        selectDay.value = id;
    }
    reportViewing(props.type);

    Inertia.on(
        "navigate",
        (event) => {
            event.preventDefault();
            isLoading.value = true;
            reportViewing(event.detail.page.props.type);
        },
        { preserveState: true }
    );

    window.Echo.channel("report").listen(
        "NewReport",
        ({ eventSlug, dayid }) => {
            if (props.slug === eventSlug && selectDay.value == dayid) {
                hasNewReport.value = true;
                isActive.value = true;
                fetchLiveReports(false);
                reportViewing(null);

                setTimeout(() => {
                    hasNewReport.value = false;
                    isActive.value = false;
                }, 5000);
            }
        }
    );
});

watch(
    () => eventStore.eventData.data,
    function () {
        eventData.value = eventStore.eventData.data;
    }
);
</script>

<style scoped>
.hide {
    display: inline !important;
    opacity: 0;
    pointer-events: none;
}

.visible {
    opacity: 1;
    pointer-events: all;
}

.custom-form-control {
    width: auto !important;
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
