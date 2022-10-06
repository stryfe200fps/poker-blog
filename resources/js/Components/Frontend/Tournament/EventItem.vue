<template>
    <div class="news-post article-post">
        <div class="row">
            <div class="col-sm-5">
                <div class="post-content">
                    <h2 style="margin-bottom: 15px">
                        <span class="label text-uppercase" :class="labelClass">
                            {{ labelText }}</span
                        >
                    </h2>
                    <h2>
                        <Link
                            class="text-capitalize"
                            :href="`/event/${event.slug}`"
                            >{{ event.title }}</Link
                        >
                    </h2>
                    <ul class="post-tags">
                        <li>
                            <i class="fa fa-clock-o"></i>
                            {{ moment(event.date_start).format("MMM D YYYY") }}
                            -
                            {{ moment(event.date_end).format("MMM D YYYY") }}
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
                        v-for="report in event.events"
                        :key="report.id"
                    >
                        <li>
                            <Link
                                class="text-capitalize"
                                :href="`/report/${report.slug}`"
                                ><i class="fa-solid fa-angle-right"></i
                                >{{ report.title }}</Link
                            >
                        </li>
                    </ul>
                </div>
                <div class="post-content" v-else>
                    <p>No reports yet</p>
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
        case "tba":
            return "label-warning";
        default:
            return "label-default";
    }
});
const labelText = computed(() => {
    switch (props.event.status) {
        case "live":
            return "live now";
        case "past":
            return "ended";
        default:
            return props.event.status;
    }
});
</script>
