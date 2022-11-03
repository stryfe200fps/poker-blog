<template>
    <Head>
        <title>{{ page_title }}</title>
    </Head>
    <FrontLayout>
        <div class="block-content">
            <div class="article-box" style="padding: 0">
                <div class="title-section">
                    <h1>
                        <span>{{ page_title }}</span>
                    </h1>
                </div>
                <div class="row" style="margin-bottom: 25px">
                    <div class="col-md-6">
                        <div class="filters left-filters">
                            <button
                                type="button"
                                class="btn btn-default"
                                @click="getDateToday()"
                            >
                                Today
                            </button>
                            <input
                                type="date"
                                v-model="selectedDate"
                                class="form-control custom-filter"
                            />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="filters right-filters">
                            <select class="form-control" v-model="selectedTour">
                                <option value="" selected disabled>Tour</option>
                                <option
                                    v-for="(tour, index) in tours"
                                    :key="index"
                                    :value="tour.slug"
                                >
                                    {{ tour.title }}
                                </option>
                            </select>
                            <select
                                class="form-control"
                                v-model="selectedCountry"
                            >
                                <option value="" selected disabled>
                                    Location
                                </option>
                                <option
                                    v-for="(country, index) in countries"
                                    :key="index"
                                    :value="country.iso_3166_2"
                                >
                                    {{ country.name }}
                                </option>
                            </select>
                            <select class="form-control" v-model="selectedGame">
                                <option value="" selected disabled>Game</option>
                                <option
                                    v-for="(game, index) in games"
                                    :key="index"
                                    :value="game.code"
                                >
                                    {{ game.title }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div v-for="(series, index) in mergeSeriesList" :key="index">
                    <div class="panel panel-default">
                        <div
                            class="panel-heading text-center"
                            style="font-family: 'Lato', sans-serif"
                        >
                            {{
                                moment(new Date(series.date)).format(
                                    "MMMM YYYY"
                                )
                            }}
                        </div>
                    </div>
                    <EventCalendarItem
                        v-for="event in series.collection"
                        :key="event.id"
                        :event="event"
                    />
                </div>
                <div
                    v-if="mergeSeriesList?.length"
                    v-observe-visibility="handleScrolledToBottom"
                ></div>
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { computed, onMounted, ref, watch } from "@vue/runtime-core";
import moment from "moment";

import FrontLayout from "@/Layouts/FrontLayout.vue";
import EventCalendarItem from "./EventCalendarItem.vue";
import { useEventCalendarStore } from "@/Stores/eventCalendar.js";

const props = defineProps({
    page_title: {
        type: String,
    },
});

const eventCalendarStore = useEventCalendarStore();
const tours = ref([]);
const selectedTour = ref("");
const countries = ref([]);
const selectedCountry = ref("");
const games = ref([]);
const selectedGame = ref("");
const seriesList = ref([]);
const selectedDate = ref(moment().format("YYYY-MM-DD"));
const currentPage = ref(1);
const lastPage = ref(1);

const filteredSeries = computed(() => {
    return {
        country: selectedCountry.value || null,
        game: selectedGame.value || null,
        tour: selectedTour.value || null,
        date_start: selectedDate.value,
    };
});

const mergeSeriesList = computed(() => {
    const mergedList = [];

    seriesList.value.forEach((item) => {
        const list = mergedList.filter((val) => val.date === item.date);

        if (list.length) {
            var existingIndex = mergedList.indexOf(list[0]);

            mergedList[existingIndex].collection = mergedList[
                existingIndex
            ].collection.concat(item.collection);
        } else {
            mergedList.push(item);
        }
    });

    return mergedList;
});

const datePlaceholder = computed(() => {
    return !selectedDate.value ? "Upcoming" : "wala";
});

function getDateToday() {
    selectedDate.value = moment().format("YYYY-MM-DD");
    selectedCountry.value = "";
    selectedGame.value = "";
    selectedTour.value = "";
}

async function handleScrolledToBottom(isVisible) {
    if (!isVisible) return;

    currentPage.value++;

    if (currentPage.value > lastPage.value) return;

    await eventCalendarStore.getSeries({
        page: currentPage.value,
        country: selectedCountry.value || null,
        game: selectedGame.value || null,
        tour: selectedTour.value || null,
        date_start: selectedDate.value,
    });
    seriesList.value.push(...eventCalendarStore.series.data);
    lastPage.value = eventCalendarStore.series.meta.last_page;
}

onMounted(async () => {
    await eventCalendarStore.getSeries({
        page: 1,
        date_start: selectedDate.value,
    });
    seriesList.value = eventCalendarStore.series.data;
    lastPage.value = eventCalendarStore.series.meta.last_page;
    await eventCalendarStore.getTours();
    tours.value = eventCalendarStore.tours.data;
    await eventCalendarStore.getCountries();
    countries.value = eventCalendarStore.countries.data;
    await eventCalendarStore.getGames();
    games.value = eventCalendarStore.games.data;
});

watch(
    () => filteredSeries.value,
    async function (value) {
        await eventCalendarStore.getSeries({
            page: 1,
            ...value,
        });
        currentPage.value = 1;
        seriesList.value = eventCalendarStore.series.data;
        lastPage.value = eventCalendarStore.series.meta.last_page;
    }
);
</script>

<style scoped>
.post-gallery {
    float: none !important;
    margin-right: 0 !important;
    margin-left: 0 !important;
}

.filters {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 15px;
}

.left-filters {
    justify-content: flex-start;
    margin-bottom: 15px;
}

.right-filters {
    display: block;
}

.right-filters select:not(:last-child) {
    margin-bottom: 15px;
}

.custom-filter {
    width: auto;
    border: none;
    box-shadow: none;
}

@media (min-width: 992px) {
    .left-filters {
        margin-bottom: 0;
    }
}

@media (min-width: 768px) {
    .right-filters {
        display: flex;
    }

    .right-filters select:not(:last-child) {
        margin-bottom: 0;
    }
}
</style>
