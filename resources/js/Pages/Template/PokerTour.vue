<template>
    <Head>
        <title>{{ tour.data.title }}</title>
    </Head>
    <FrontLayout>
        <div class="block-content">
            <div class="single-post-box">
                <div class="title-section">
                    <h1 class="text-primary">
                        <span style="cursor: pointer" @click="goBack"
                            ><i
                                class="fa fa-chevron-left"
                                aria-hidden="true"
                            ></i>
                            to poker tour</span
                        >
                    </h1>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="post-content">
                            <h2
                                class="text-capitalize"
                                style="margin-bottom: 15px"
                            >
                                <span>{{ tour.data.title }}</span>
                            </h2>
                            <p>{{ tour.data.description }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="post-gallery">
                            <img
                                v-if="tour.data.image_set"
                                :src="tour.data.image_set.lg_image"
                                :alt="tour.data.image_set.lg_image"
                            />
                            <img v-else :src="defaultImg" :alt="defaultImg" />
                        </div>
                    </div>
                </div>
                <div class="grid-box filters" v-if="seriesList.length">
                    <h4>View Series By Year</h4>
                    <div>
                        <select class="form-control" v-model="selectedYear">
                            <option value="" selected disabled>
                                Select Year
                            </option>
                            <option
                                v-for="(year, index) in years"
                                :key="index"
                                :value="year"
                            >
                                {{ year }}
                            </option>
                        </select>
                    </div>
                    <button
                        class="btn btn-default"
                        v-if="selectedYear !== ''"
                        @click="resetFilter()"
                    >
                        Reset
                    </button>
                </div>
                <div class="forum-table" v-if="seriesList.length">
                    <div
                        class="table-head"
                        style="background-color: rgb(45, 52, 54) !important"
                    >
                        <div class="first-col" style="width: 50%">
                            <span>Series</span>
                        </div>
                        <div class="second-col" style="width: 20%">
                            <span>Date</span>
                        </div>
                        <div class="third-col" style="width: 25%">
                            <span>Location</span>
                        </div>
                    </div>
                    <SeriesTable
                        v-for="series in seriesList"
                        :key="series.id"
                        :series="series"
                        :tourSlug="tour.data.slug"
                    />
                </div>
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { useTourStore } from "@/Stores/pokerTour.js";
import { onMounted, ref, computed, watch } from "@vue/runtime-core";

import FrontLayout from "@/Layouts/FrontLayout.vue";
import SeriesTable from "../Series/SeriesTable.vue";
import defaultImg from "/public/default-img.png";

const props = defineProps({
    tour: {
        type: Object,
    },
});

const years = ref([]);
const seriesList = ref([]);
const selectedYear = ref("");
const pokerTourStore = useTourStore();

const filteredYear = computed(() => {
    return {
        slug: props.tour.data.slug,
        year: selectedYear.value || null,
    };
});

function goBack() {
    Inertia.visit("/tours");
}

function resetFilter() {
    selectedYear.value = "";
}

onMounted(async () => {
    await pokerTourStore.getYears(props.tour.data.slug);
    years.value = pokerTourStore.years.data;
    await pokerTourStore.getSeriesList(filteredYear.value);
    seriesList.value = pokerTourStore.seriesList.tournaments.data;
});

watch(
    () => filteredYear.value,
    async function (value) {
        await pokerTourStore.getSeriesList({
            ...value,
        });
        seriesList.value = pokerTourStore.seriesList.tournaments.data;
    }
);
</script>

<style scoped>
.post-gallery {
    float: none !important;
    margin-inline: 0 !important;
    margin-block-end: 0 !important;
}

.filters {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 15px;
    margin-bottom: 40px;
    font-family: "Lato", sans-serif;
}
</style>
