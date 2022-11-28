<template>
    <div class="single-post-box round">
        <EachReport
            v-for="(item, index) in report.collection"
            :key="index"
            :item="item"
            :event="event"
            :id="index"
            :url="url"
        />
        <div
            class="day-divider"
            style="
                border-bottom: 1px solid #d3d3d3;
                margin-top: 20px;
                margin-bottom: 25px;
            "
        >
            <span>{{ report.level }}</span
            ><br />
        </div>
    </div>
</template>

<script setup>
import EachReport from "./EachReport.vue";

const props = defineProps({
    report: {
        type: Object,
    },
    event: {
        type: Object,
    },
    url: {
        type: String,
    },
});
</script>
