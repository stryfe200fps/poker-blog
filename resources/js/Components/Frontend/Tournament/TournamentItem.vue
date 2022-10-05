<template>
    <div class="tour-wrapper">
        <div class="news-post article-post">
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
                                <i class="fa fa-clock-o"></i
                                >{{ tournament.date_start }} -
                                {{ tournament.date_end }}
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
import defaultImg from "/public/default-img.png";
import EventItem from "./EventItem.vue";
const props = defineProps({
    tournament: Object,
});
</script>

<style scoped>
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
    background-color: #fafafa;
    border-radius: 5px;
}

.tour-wrapper .article-post:last-child {
    margin-bottom: 0;
    border: 0;
}
</style>
