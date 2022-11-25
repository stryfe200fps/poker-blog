<template>
    <iframe
        :src="`${link}embed`"
        width="320"
        height="466"
        allowtransparency="true"
        allowfullscreen="true"
        frameborder="0"
        scrolling="no"
        style="
            width: 100%;
            border: 0.05rem solid rgb(190, 190, 190);
            border-radius: 5px;
        "
    ></iframe>
</template>

<script setup>
const props = defineProps({
    link: {
        type: String,
    },
});
</script>
