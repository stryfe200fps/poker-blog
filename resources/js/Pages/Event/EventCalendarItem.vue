<template>
    <div class="news-post article-post">
        <div class="row">
            <div class="col-sm-1">
                <div class="panel panel-default">
                    <div
                        class="panel-heading text-center text-uppercase"
                        style="padding: 2px; font-size: 12px"
                        v-if="event.date_start"
                    >
                        {{ moment(new Date(event?.date_start)).format("ddd") }}
                    </div>
                    <div
                        class="panel-heading text-center text-uppercase"
                        style="padding: 2px; font-size: 12px"
                        v-else
                    >
                        date
                    </div>
                    <div
                        class="panel-body text-center text-uppercase"
                        style="padding: 5px; font-size: 20px"
                        v-if="event.date_start"
                    >
                        {{ moment(new Date(event?.date_start)).format("D") }}
                    </div>
                    <div
                        class="panel-body text-center text-uppercase"
                        style="padding: 5px; font-size: 24px"
                        v-else
                    >
                        ?
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="post-content">
                    <ul class="post-tags">
                        <li
                            style="
                                color: inherit;
                                font-size: 13px;
                                font-style: normal;
                            "
                            v-if="event.date_start"
                        >
                            <i class="fa fa-clock-o" style="color: inherit"></i
                            >{{ formattedDate }}
                        </li>
                        <li
                            style="
                                color: inherit;
                                font-size: 13px;
                                font-style: normal;
                            "
                            v-else
                        >
                            <i class="fa fa-clock-o" style="color: inherit"></i
                            >{{ event.date_range }}
                        </li>
                    </ul>
                    <h2 style="margin-bottom: 2px">
                        <Link
                            :href="`/tour/${event.poker_tour_slug}/${event.slug}`"
                            >{{ event.title }}</Link
                        >
                    </h2>
                    <ul class="post-tags">
                        <li
                            style="
                                color: inherit;
                                font-size: 13px;
                                font-style: normal;
                            "
                        >
                            <i>
                                <CountryFlag
                                    :title="event.country.name"
                                    :iso="event.country.iso_3166_2"
                            /></i>
                            {{ event.country.capital }},
                            {{ event.country.name }}
                        </li>
                    </ul>

                    <p>
                        {{ event.description }}
                    </p>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="post-gallery">
                    <img
                        v-if="event.image_set"
                        :src="event.image_set.md_image"
                        :alt="event.image_set.md_image"
                    />
                    <img v-else :src="defaultImg" :alt="defaultImg" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { computed } from "@vue/runtime-core";
import CountryFlag from "vue3-country-flag-icon";
import moment from "moment";

import defaultImg from "/public/default-img.png";

const props = defineProps({
    event: {
        type: Object,
    },
});

const formattedDate = computed(() => {
    const startYear = moment(new Date(props.event?.date_start)).format("YYYY");
    const endYear = moment(new Date(props.event?.date_end)).format("YYYY");
    const startMonth = moment(new Date(props.event?.date_start)).format("MMMM");
    const endMonth = moment(new Date(props.event?.date_end)).format("MMMM");
    const startDay = moment(new Date(props.event?.date_start)).format("D");
    const endDay = moment(new Date(props.event?.date_end)).format("D");
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
