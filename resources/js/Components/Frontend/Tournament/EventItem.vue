<template>
    <div class="news-post article-post article-post--custom">
        <div
            class="row"
            v-if="event.status !== 'upcoming' && event.status !== 'tba'"
        >
            <div class="col-sm-5">
                <div class="post-content">
                    <h2 style="margin-bottom: 15px">
                        <span class="label text-uppercase" :class="labelClass">
                            {{ labelText }}</span
                        >
                    </h2>
                    <h2 v-if="event.events.length">
                        <Link
                            class="text-capitalize link--custom"
                            :href="`/tours/${event.tour_slug}/${event.tournament_slug}/${event.slug}`"
                            >{{ event.title }}
                        </Link>
                        <p
                            style="
                                margin-top: 5px;
                                font-size: 12px;
                                font-style: italic;
                            "
                            v-if="event.game_table"
                        >
                            Event Game: {{ event.game_table }}
                        </p>
                        <p
                            style="
                                margin-top: -15px;
                                font-size: 12px;
                                font-style: italic;
                            "
                            v-if="event.buyin"
                        >
                            Buy In: {{ event.buyin }}
                        </p>
                        <p
                            style="
                                margin-top: -15px;
                                font-size: 12px;
                                font-style: italic;
                            "
                            v-if="event.fee"
                        >
                            Fee: {{ event.fee }}
                        </p>
                    </h2>
                    <h2 v-else>
                        {{ event.title }}
                        <p
                            style="
                                margin-top: 5px;
                                font-size: 12px;
                                font-style: italic;
                            "
                            v-if="event.game_table"
                        >
                            Event Game: {{ event.game_table }}
                        </p>
                        <p
                            style="
                                margin-top: -15px;
                                font-size: 12px;
                                font-style: italic;
                            "
                            v-if="event.buyin"
                        >
                            Buy In: {{ event.buyin }}
                        </p>
                        <p
                            style="
                                margin-top: -15px;
                                font-size: 12px;
                                font-style: italic;
                            "
                            v-if="event.fee"
                        >
                            Fee: {{ event.fee }}
                        </p>
                    </h2>
                    <ul
                        class="post-tags"
                        style="margin-top: -15px"
                        v-if="event.schedule.date_start"
                    >
                        <li>
                            <i class="fa fa-clock-o"></i>
                            {{ formattedDate }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <p class="text-uppercase" style="color: #333">
                    <strong>latest updates</strong>
                </p>
                <div class="post-content" v-if="event.events.length">
                    <ul
                        class="post-tags post-tags--custom"
                        v-for="(report, index) in event.events"
                        :key="report.id"
                    >
                        <li>
                            <Link
                                class="text-capitalize link--custom"
                                v-if="index == 1"
                                :href="`/tours/${event.tour_slug}/${
                                    event.tournament_slug
                                }/${event.slug}/${report.day?.name
                                    .replace(/[^A-Z0-9]+/gi, '-')
                                    .toLowerCase()}#${report.id}`"
                                ><i
                                    class="fa-solid fa-angle-right link-icon--custom"
                                ></i
                                >{{ report.title }}</Link
                            >
                            <Link
                                v-else
                                class="text-capitalize link--custom"
                                :href="`/tours/${event.tour_slug}/${
                                    event.tournament_slug
                                }/${event.slug}/${report.day?.name
                                    .replace(/[^A-Z0-9]+/gi, '-')
                                    .toLowerCase()}`"
                                ><i
                                    class="fa-solid fa-angle-right link-icon--custom"
                                ></i
                                >{{ report.title }}</Link
                            >
                        </li>
                    </ul>
                </div>
                <div class="post-content" v-else>
                    <h5>
                        <small>
                            <i
                                class="fas fa-file-edit"
                                style="margin-right: 5px"
                            ></i
                            >No reports yet</small
                        >
                    </h5>
                </div>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col-sm-12">
                <div class="post-content">
                    <h2 style="margin-bottom: 15px">
                        <span
                            v-if="event.schedule?.date_start"
                            class="label text-uppercase"
                            :class="labelClass"
                        >
                            {{ labelText }}</span
                        >
                        <span v-else class="label label-warning text-uppercase">
                            {{ event.schedule }}</span
                        >
                    </h2>
                    <div
                        style="
                            display: flex;
                            justify-content: space-between;
                            align-items: baseline;
                            flex-wrap: wrap;
                        "
                    >
                        <h2 class="text-capitalize">
                            {{ event.title }}
                            <p
                                style="
                                    margin-top: 5px;
                                    font-size: 12px;
                                    font-style: italic;
                                "
                                v-if="event.game_table"
                            >
                                Event Game: {{ event.game_table }}
                            </p>
                            <p
                                style="
                                    margin-top: -15px;
                                    font-size: 12px;
                                    font-style: italic;
                                "
                                v-if="event.buyin"
                            >
                                Buy In: {{ event.buyin }}
                            </p>
                            <p
                                style="
                                    margin-top: -15px;
                                    font-size: 12px;
                                    font-style: italic;
                                "
                                v-if="event.fee"
                            >
                                Fee: {{ event.fee }}
                            </p>
                        </h2>
                        <p
                            v-if="event.schedule?.date_start"
                            class="text-uppercase"
                            style="color: #333"
                        >
                            {{ formattedDate }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "@vue/runtime-core";
import { Head, Link } from "@inertiajs/inertia-vue3";
import moment from "moment";

const props = defineProps({
    event: Object,
});

const labelClass = computed(() => {
    switch (props.event.status) {
        case "live":
            return "label-danger";
        case "upcoming":
            return "label-success";
        case "end":
            return "label-default";
        default:
            return "label-warning";
    }
});
const labelText = computed(() => {
    switch (props.event.status) {
        case "live":
            return "live now";
        case "end":
            return "ended";
        case "upcoming":
            return "upcoming";
        default:
            return props.event.status;
    }
});

const formattedDate = computed(() => {
    const startYear = moment(props.event.schedule?.date_start).format("YYYY");
    const endYear = moment(props.event.schedule?.date_end).format("YYYY");
    const startMonth = moment(props.event.schedule?.date_start).format("MMMM");
    const endMonth = moment(props.event.schedule?.date_end).format("MMMM");
    const startDay = moment(props.event.schedule?.date_start).format("D");
    const endDay = moment(props.event.schedule?.date_end).format("D");
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

<style scoped>
.article-post--custom {
    border-bottom-color: #d0d0d0;
}

.link--custom,
.link-icon--custom {
    color: #f44336 !important;
}
</style>
