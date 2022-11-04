<template>
    <div class="table-row">
        <div class="first-col" style="width: 25%">
            <h2>{{ formattedDate }}</h2>
        </div>
        <div class="second-col" style="width: 50%">
            <h2>{{ event.title }}</h2>
        </div>
        <div class="third-col" style="width: 25%">
            <h2>{{ event.buyin }}</h2>
        </div>
    </div>
</template>

<script setup>
import { computed } from "@vue/runtime-core";
import moment from "moment";

const props = defineProps({
    event: {
        type: Object,
    },
});

const formattedDate = computed(() => {
    const startYear = moment(
        new Date(props.event?.schedule?.date_start)
    ).format("YYYY");
    const endYear = moment(new Date(props.event?.schedule?.date_end)).format(
        "YYYY"
    );
    const startMonth = moment(
        new Date(props.event?.schedule?.date_start)
    ).format("MMMM");
    const endMonth = moment(new Date(props.event?.schedule?.date_end)).format(
        "MMMM"
    );
    const startDay = moment(new Date(props.event?.schedule?.date_start)).format(
        "D"
    );
    const endDay = moment(new Date(props.event?.schedule?.date_end)).format(
        "D"
    );
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
