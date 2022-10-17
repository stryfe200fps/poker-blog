<template>
    <div class="tour-wrapper">
        <div class="news-post article-post article-post--custom">
            <div class="row">
                <div class="col-sm-5">
                    <div class="post-gallery">
                        <img
                            v-if="tournament.main_thumb"
                            :src="tournament.main_thumb"
                            :alt="tournament.main_thumb"
                        />
                        <img v-else :src="defaultImg" :alt="defaultImg" />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="post-content">
                        <h4 class="text-uppercase">
                            {{ tournament.poker_tour }}
                        </h4>
                        <h3 class="text-capitalize" style="color: #333">
                            {{ tournament.title }}
                        </h3>
                        <ul class="post-tags post-tags--custom">
                            <li>
                                <i class="fa fa-clock-o"></i>{{ formattedDate }}
                            </li>
                            <li>
                                <i class="fa fa-map-marker"></i
                                >{{ tournament.country?.capital }},
                                {{ tournament.country?.name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <EventItem
            v-for="event in tournament.events.data"
            :key="event.id"
            :event="event"
        />
    </div>
</template>

<script setup>
import { computed } from "@vue/runtime-core";
import moment from "moment";
import defaultImg from "/public/default-img.png";
import EventItem from "./EventItem.vue";
const props = defineProps({
    tournament: Object,
});

const formattedDate = computed(() => {
    const startYear = moment(new Date(props.tournament?.date_start)).format(
        "YYYY"
    );
    const endYear = moment(new Date(props.tournament?.date_end)).format("YYYY");
    const startMonth = moment(new Date(props.tournament?.date_start)).format(
        "MMMM"
    );
    const endMonth = moment(new Date(props.tournament?.date_end)).format(
        "MMMM"
    );
    const startDay = moment(new Date(props.tournament?.date_start)).format("D");
    const endDay = moment(new Date(props.tournament?.date_end)).format("D");
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

.post-gallery {
    float: none !important;
    margin-right: 0 !important;
    margin-left: 0 !important;
}

.post-tags--custom {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-direction: column;
    gap: 5px;
}

.tour-wrapper {
    margin-bottom: 30px;
    padding: 15px 15px 0 15px;
    background-color: #f5f5f5;
    border-radius: 5px;
}

.tour-wrapper .article-post:last-child {
    margin-bottom: 0;
    border: 0;
}
</style>
