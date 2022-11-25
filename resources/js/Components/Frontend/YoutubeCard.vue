<template>
    <div class="col-md-4" style="margin-bottom: 20px">
        <div class="new-post standard-post2">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe
                    class="embed-responsive-item"
                    :src="`https://www.youtube.com/embed/${youtube}`"
                    title="YouTube video player"
                    frameborder="0"
                    loading="lazy"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    youtube: {
        type: String,
    },
});
</script>
