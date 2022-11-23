<template>
    <Head>
        <title>{{ page_title }}</title>
    </Head>
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
                        <div class="custom-date-picker">
                            <div
                                class="custom-date-picker__btn"
                                @click="openDatePicker"
                                @blur="isOpen = false"
                                tabindex="0"
                            >
                                <span>{{ datePlaceholder }}</span>
                                <i
                                    class="fas fa-angle-down custom-date-picker__icon"
                                    :class="{ up: isOpen }"
                                ></i>
                            </div>
                            <div>
                                <input
                                    type="date"
                                    v-model="selectedDate"
                                    class="custom-date-picker__input"
                                    id="custom-date"
                                    @change="changeDate"
                                />
                            </div>
                        </div>
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
                        <select class="form-control" v-model="selectedCountry">
                            <option value="" selected disabled>Location</option>
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
                        <button
                            class="btn btn-default reset-btn"
                            v-if="
                                selectedTour !== '' ||
                                selectedCountry !== '' ||
                                selectedGame !== ''
                            "
                            @click="resetFilter()"
                        >
                            Reset
                        </button>
                    </div>
                </div>
            </div>
            <div v-if="isLoading">
                <LoadingBar />
            </div>
            <div v-else>
                <div v-if="seriesList?.length">
                    <div v-for="(series, index) in seriesList" :key="index">
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
                        v-if="seriesList?.length"
                        v-observe-visibility="handleScrolledToBottom"
                    ></div>
                </div>
                <div v-else style="margin-top: 45px">
                    <h4>There are no events at the moment.</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { computed, onMounted, ref, watch } from "@vue/runtime-core";
import { useEventCalendarStore } from "@/Stores/eventCalendar.js";
import moment from "moment";

import LoadingBar from "@/Components/LoadingBar.vue";
import EventCalendarItem from "@/Components/Frontend/EventCalendarItem.vue";

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
const isOpen = ref(false);
const isLoading = ref(true);

const filteredSeries = computed(() => {
    return {
        country: selectedCountry.value || null,
        game: selectedGame.value || null,
        tour: selectedTour.value || null,
        date_start: selectedDate.value,
    };
});

const datePlaceholder = computed(() => {
    return selectedDate.value === moment().format("YYYY-MM-DD")
        ? "Upcoming"
        : `${moment(new Date(selectedDate.value)).format("MMMM D")} onwards`;
});

function getDateToday() {
    selectedDate.value = moment().format("YYYY-MM-DD");
}

function resetFilter() {
    selectedCountry.value = "";
    selectedGame.value = "";
    selectedTour.value = "";
}

function openDatePicker() {
    document.getElementById("custom-date").showPicker();
    isOpen.value = !isOpen.value;
}

function changeDate() {
    isOpen.value = false;
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
    eventCalendarStore.series.data.forEach((data) => {
        const list = seriesList.value.filter((val) => val.date === data.date);
        if (list.length) {
            const index = seriesList.value.indexOf(list[0]);

            seriesList.value[index].collection = seriesList.value[
                index
            ].collection.concat(data.collection);
        } else {
            seriesList.value.push(data);
        }
    });
    lastPage.value = eventCalendarStore.series.meta.last_page;
}

onMounted(async () => {
    await eventCalendarStore.getSeries({
        page: 1,
        date_start: selectedDate.value,
    });
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
        isLoading.value = true;
        await eventCalendarStore.getSeries({
            page: 1,
            ...value,
        });
        seriesList.value = eventCalendarStore.series.data;
        currentPage.value = 1;
        lastPage.value = eventCalendarStore.series.meta.last_page;

        if (seriesList.value) isLoading.value = false;
    },
    { immediate: true }
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

.custom-date-picker {
    position: relative;
}

.custom-date-picker__btn {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 10px;
    cursor: pointer;
}

.custom-date-picker__icon {
    transition: transform 0.5s ease;
}

.custom-date-picker__icon.up {
    transform: rotate(180deg);
}

.custom-date-picker__input {
    position: absolute;
    top: -15px;
    z-index: -1;
    pointer-events: none;
    opacity: 0;
}

.reset-btn {
    margin-bottom: 15px;
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

    .reset-btn {
        margin-bottom: 0;
    }
}
</style>
