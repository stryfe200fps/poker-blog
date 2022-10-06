<template>
    <FrontLayout title="Event">
        <div v-if="eventData">
            <div v-if="liveReport"></div>
            <div class="block-content" v-if="1">
                <!-- <div class="block-content" v-if="list.data"> -->
                <div class="title-section">
                    <h1>
                        <span>{{ eventData.tournament }}</span>
                    </h1>
                </div>
                <div class="title-section hide-underline">
                    <!-- <h1 class="text-primary"><span>{{list.data.poker_tournament}}</span></h1> -->
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
                        <!-- <h1><span>{{list.data.title}}</span></h1> -->
                        <p>
                            <select
                                class="form-control"
                                v-model="selectDay"
                                @change="fetchLiveReports"
                            >
                                <option
                                    class="text-center"
                                    v-for="(
                                        data, index
                                    ) in eventData.available_days"
                                    :key="index"
                                    :value="data"
                                    :checked="data == selectDay"
                                >
                                    Day {{ data }}
                                </option>
                            </select>
                        </p>
                    </div>
                </div>
                <div class="single-post-box">
                    <ReportList :event="eventData" :reports="liveReport" />
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

import { useEventStore } from "@/stores/event.js";
import { useTournamentStore } from "@/stores/tournament.js";
import { onMounted, ref, watch } from "@vue/runtime-core";

const eventStore = useEventStore();
const tournamentStore = useTournamentStore();

const props = defineProps({
    slug: {
        type: String,
    },
});

const eventData = ref([]);
const selectDay = ref(null);
const liveReport = ref([]);

const highestDay = () => {
    let { available_days } = eventStore.eventData.data;
    let days = Object.values(available_days);
    return days.toString();
};

onMounted(async () => {
    await eventStore.getEventData(props.slug);
    await tournamentStore.getList();
    await eventStore.getLiveReport(props.slug, highestDay());
    selectDay.value = highestDay();
});

const fetchLiveReports = async () => {
    await eventStore.getLiveReport(props.slug, selectDay.value);
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

watch(
    () => eventStore.liveReportList,
    function () {
        liveReport.value = eventStore.liveReportList.data;
    }
);
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
