<template>
    <Tweet :tweet-id="tweet.id" cards="hidden" conversation="none">
        <template v-slot:loading>
            <TwitterSkeleton />
        </template>
    </Tweet>
</template>

<script setup>
import Tweet from "vue-tweet";
import TwitterSkeleton from "./TwitterSekeleton.vue";

const props = defineProps({
    tweet: {
        type: Object,
    },
});
</script>
