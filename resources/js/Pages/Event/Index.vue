
<template>
        <FrontLayout title="Event">

            <div v-if="eventData">

                <div v-if="liveReport"> 
                    </div>
            <div class="block-content" v-if="1">
                <!-- <div class="block-content" v-if="list.data"> -->
                <div class="title-section hide-underline">
                    <!-- <h1 class="text-primary"><span>{{list.data.poker_tournament}}</span></h1> -->
                    <h1 class="text-primary"><span>{{ eventData.tournament }}</span></h1>
                    <div style="display:flex; justify-content: space-between; align-items: center;">
                        <h1><span>{{eventData.title}}</span></h1>
                        <!-- <h1><span>{{list.data.title}}</span></h1> -->
                        <p>
                        <select @change="fetchLiveReports()" v-model="days" style="padding: 4px 8px; outline: none;">
                            <option ref="selectDay" :value="data" :key="data.id" v-for="data in eventData.available_days"> Day {{ data }}  </option>
                        </select>
                        </p>
                    </div>
                </div>
                <div class="single-post-box">
                    <ReportList :event="eventData" :reports="liveReport" />
                </div>

            </div>
        </div>
        </FrontLayout>
   
</template>


<script setup>
import { Head, InertiaLink  } from '@inertiajs/inertia-vue3';
import FrontLayout from '@/Layouts/FrontLayout.vue';
import ReportList from '../../Components/Frontend/Report/ReportList.vue';
import SideBar from '../../Components/Frontend/MainContent/SideBar.vue';
import TournamentList from '../../Components/Frontend/Tournament/List.vue';

import { useEventStore } from '@/stores/event.js'
import { useTournamentStore } from '@/stores/tournament.js'
import { onMounted, ref, watch } from '@vue/runtime-core';

const eventStore = useEventStore()
const tournamentStore = useTournamentStore()
const selectDay = ref(null);
const props = defineProps({

id : {
    type: String
}
});

const days = ref(1)
const eventData = ref([])
const liveReport = ref([])

onMounted(async() => {
    await  eventStore.getEventData(props.id)
    await  tournamentStore.getList()
    await eventStore.getLiveReport(props.id)
    
    // selectDay.value[0].setAttribute("selected", true);

    if (eventStore.eventData.data) {
        days.value = Object.keys(eventData.value.available_days)[0]
        fetchLiveReports()
    } 
});

const fetchLiveReports = async () => {
   await eventStore.getLiveReport(props.id, days.value)

   // change later with Laravel broadcast, this is not a good idea, but this will do for now.
    setInterval(() => {
        eventStore.getLiveReport(props.id, days.value)
    }, 30000);
}

const fetchPage = async () => {
    await eventStore.fetchWithPaginate(props.id,days.value)
}

watch(() => eventStore.eventData.data, function () {
    eventData.value = eventStore.eventData.data;
  }
);

watch(() => eventStore.liveReportList, function () {
    liveReport.value = eventStore.liveReportList.data;
  }
);

</script>

<style scoped>
.text-secondary {
    color: #2d3436 !important;
}

.single-post-box > .post-content p {
    padding: unset;
}

.single-post-box .share-post-box ul.share-box li a {
    padding: 4px 16px;
    margin-left: 5px;
    margin-bottom: 5px;
}

.margin-top {
    margin-top: 20px;
}

.facebook {
    background-color: unset;
    margin-left: 10px;
}
.twitter {
    background-color: unset;
}
.whatsapp {
    background-color: unset;
}

.each-post {
    border-top: 1px solid #d3d3d3;
    border-bottom: 1px solid #d3d3d3;
}


/* ul.post-tags li .twitter, 
ul.post-tags li .facebook, 
ul.post-tags li .whatsapp {
   font-size: 18px;
} */

@media(min-width:768px) {
    .post-content-min-height {
        min-height: 200px;
    }
}

@media(min-width:992px) {
    .post-content-min-height {
        min-height: 250px;  
    }
}

@media(min-width:1200px) {
    .post-content-min-height {
        min-height: 300px;
    }
}
</style>
