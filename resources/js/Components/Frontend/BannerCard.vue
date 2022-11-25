<template>
    <div class="desktop-advert">
        <img
            :src="banner.image_set?.og_image"
            :alt="banner.image_set?.og_image"
            loading="lazy"
            style="max-width: 100%; height: auto"
        />
    </div>
    <div class="tablet-advert">
        <img
            :src="banner.image_set?.og_image"
            :alt="banner.image_set?.og_image"
            loading="lazy"
            style="max-width: 100%; height: auto"
        />
    </div>
    <div class="mobile-advert">
        <img
            :src="banner.image_set?.og_image"
            :alt="banner.image_set?.og_image"
            loading="lazy"
            style="max-width: 100%; height: auto"
        />
    </div>
</template>

<script setup>
const props = defineProps({
    banner: {
        type: Object,
    },
});
</script>
