<template>
    <div class="table-row">
        <div class="first-col" style="width: 50%">
            <h2>
                <Link :href="`/tour/${tourSlug}/${series.slug}`">{{
                    series.title
                }}</Link>
            </h2>
            <p>
                {{ series.description }}
            </p>
        </div>
        <div class="second-col" style="width: 20%">
            <h2 v-if="series.date_start">{{ formattedDate }}</h2>
            <h2 v-else>TBA</h2>
        </div>
        <div class="third-col" style="width: 25%">
            <h2>
                <CountryFlag
                    :title="series.country?.name"
                    :iso="series.country?.iso_3166_2"
                />
                <span
                    style="
                        margin-left: 5px;
                        text-transform: capitalize;
                        font-size: 13px;
                        color: #2d3436;
                    "
                    >{{ series.country?.name }}</span
                >
            </h2>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { computed } from "@vue/runtime-core";
import moment from "moment";
import CountryFlag from "vue3-country-flag-icon";
const props = defineProps({
    series: {
        type: Object,
    },
    tourSlug: {
        type: String,
    },
});

const formattedDate = computed(() => {
    const startYear = moment(new Date(props.series?.date_start)).format("YYYY");
    const endYear = moment(new Date(props.series?.date_end)).format("YYYY");
    const startMonth = moment(new Date(props.series?.date_start)).format(
        "MMMM"
    );
    const endMonth = moment(new Date(props.series?.date_end)).format("MMMM");
    const startDay = moment(new Date(props.series?.date_start)).format("D");
    const endDay = moment(new Date(props.series?.date_end)).format("D");
    if (
        startYear === endYear &&
        startMonth === endMonth &&
        startDay === endDay
    ) {
        return `${endMonth} ${endDay}, ${endYear}`;
    } else if (
        startYear === endYear &&
        startMonth === endMonth &&
        startDay !== endDay
    ) {
        return `${endMonth} ${startDay} - ${endDay}, ${endYear}`;
    } else if (
        startYear === endYear &&
        startMonth !== endMonth &&
        startDay !== endDay
    ) {
        return `${startMonth} ${startDay} - ${endMonth} ${endDay}, ${endYear}`;
    } else {
        return `${startMonth} ${startDay}, ${startYear} - ${endMonth} ${endDay}, ${endYear}`;
    }
});
</script>
