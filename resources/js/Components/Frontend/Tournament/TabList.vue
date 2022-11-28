<template>
    <ul class="nav nav-tabs custom-tabs">
        <li
            @click.prevent="changeTab(currentTab)"
            :class="{ active: currentTab === 'live' }"
        >
            <Link href="/live-reporting" data-toggle="tab" preserve-state
                ><span class="hidden-xs">live & upcoming events</span
                ><span class="visible-xs">live & upcoming</span></Link
            >
        </li>
        <li
            @click.prevent="changeTab(currentTab)"
            :class="{ active: currentTab === 'past' }"
        >
            <Link href="/live-reporting/past" data-toggle="tab" preserve-state
                ><span class="hidden-xs">past events</span
                ><span class="visible-xs">past</span>
            </Link>
        </li>
    </ul>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/runtime-core";

const props = defineProps({
    currentTab: {
        type: String,
    },
});

const tab = ref("");

function changeTab(currentTab) {
    tab.value = currentTab;
}
</script>

<style scoped>
.custom-tabs {
    position: sticky;
    position: -webkit-sticky;
    top: 0;
    z-index: 999;
    transition: all 0.5s ease;
}
</style>
