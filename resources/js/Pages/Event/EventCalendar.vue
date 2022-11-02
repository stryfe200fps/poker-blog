<template>
    <Head>
        <title>{{ page_title }}</title>
    </Head>
    <FrontLayout>
        <div class="block-content">
            <div class="article-box">
                <div class="title-section">
                    <h1>
                        <span>{{ page_title }}</span>
                    </h1>
                </div>
                <div class="row" style="margin-bottom: 25px">
                    <div class="col-md-6">
                        <div class="filters left-filters">
                            <button type="button" class="btn btn-default">
                                Today
                            </button>
                            <input
                                type="date"
                                class="form-control custom-filter"
                            />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="filters right-filters">
                            <select
                                class="form-control"
                                v-model="selectedTour"
                                @change="filterByTour"
                            >
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
                                @change="filterByCountry"
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
                            <select
                                class="form-control"
                                v-model="selectedGame"
                                @change="filterByGame"
                            >
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
                <div class="panel panel-default">
                    <div
                        class="panel-heading text-center"
                        style="font-family: 'Lato', sans-serif"
                    >
                        November
                    </div>
                </div>
                <EventCalendarItem
                    v-for="event in events"
                    :key="event.id"
                    :event="event"
                />
                <div
                    v-if="events?.length"
                    v-observe-visibility="handleScrolledToBottom"
                ></div>
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "@vue/runtime-core";

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
const events = ref([]);
const currentPage = ref(1);
const lastPage = ref(1);

function filterByTour() {
    console.log(selectedTour.value);
}

function filterByCountry() {
    console.log(selectedCountry.value);
}

function filterByGame() {
    console.log(selectedGame.value);
}

async function handleScrolledToBottom(isVisible) {
    if (!isVisible) return;

    currentPage.value++;

    if (currentPage.value > lastPage.value) return;

    await eventCalendarStore.getEvents(currentPage.value);
    events.value.push(...eventCalendarStore.events.data);
    lastPage.value = eventCalendarStore.events.meta.last_page;
}

onMounted(async () => {
    await eventCalendarStore.getEvents(1);
    events.value = eventCalendarStore.events.data;
    lastPage.value = eventCalendarStore.events.meta.last_page;
    await eventCalendarStore.getTours();
    tours.value = eventCalendarStore.tours.data;
    await eventCalendarStore.getCountries();
    countries.value = eventCalendarStore.countries.data;
    await eventCalendarStore.getGames();
    games.value = eventCalendarStore.games.data;
});
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
