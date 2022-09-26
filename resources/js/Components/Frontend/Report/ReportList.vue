<template>
    <div class="about-more-autor">
        <ul class="nav nav-tabs">
            <li @click.prevent="changeTab(0)" :class="tab == 0 ? 'active': '' ">
                <a href="#about-autor" data-toggle="tab">
                    <span class="hide-on-mobile">LIVE UPDATES</span>
                    <span class="show-on-mobile">UPDATES</span>
                </a>
            </li>
            <li @click.prevent="changeTab(1)" :class="tab == 1 ? 'active': '' ">
                <a href="#more-autor" data-toggle="tab">
                    <span class="hide-on-mobile">CHIP COUNTS</span>
                    <span class="show-on-mobile">CHIPS</span>
                </a>
            </li>
            <li @click.prevent="changeTab(2)" :class="tab == 2 ? 'active': '' ">
                <a href="#more-autor" data-toggle="tab">GALLERY</a>
            </li>
             <li @click.prevent="changeTab(3)" :class="tab == 3 ? 'active': '' ">
                <a href="#more-autor" data-toggle="tab">PAYOUT</a>
            </li>
            <li @click.prevent="changeTab(4)" :class="tab == 4 ? 'active': '' ">
                <a href="#more-autor" data-toggle="tab">#WHATSAPP</a>
            </li>
        </ul>
        <div class="tab-content">
            <div v-show="tab == 0 && reports.length"  id="liveReport">
                <div v-for="(reports, level, index) in groupedReports" :key="index" class="single-post-box round">
                    <EachReport v-for="(item, index) in reports" :key="index" :item="item"/>

                    <div class="day-divider" style="border-bottom: 1px solid #d3d3d3; margin-top: 20px;">
                        <span>{{ level }}</span><br />
                    </div>
                    <EachReport v-for="(item, index) in reports" :key="index" :item="item"/>
                </div>
            </div>
            <div v-show="tab == 1">
                <div class="margin-top">
                    <CustomeTable v-if="event?.chip_stacks?.length">
                        <template v-slot:table-head>
                            <tr class="text-primary">
                                <th class="text-center">Rank</th>
                                <th>Player</th>
                                <th class="text-center hide-on-tablet">Country</th>
                                <th class="text-right">Chips</th>
                                <th class="text-right hide-on-mobile">Progress</th>
                            </tr>
                        </template>
                        <template v-slot:table-body>
                            <tr v-for="(stack, index ) in event.chip_stacks" :key="stack?.player?.id">
                                <td class="text-center">{{ index+1 }}</td>
                                <td>
                                    <img class="hide-on-tablet" v-if="stack?.player?.avatar" :src="stack?.player?.avatar" />
                                    <img class="hide-on-tablet" v-else :src="defaultAvatar" />
                                    <span style="white-space: nowrap;">{{stack?.player?.name}}</span>
                                </td>
                                <td class="text-center hide-on-tablet" v-if="stack?.player?.country"><CountryFlag :title="stack?.player?.country?.name" :iso="stack?.player?.country?.iso_3166_2" /></td>
                                <td class="text-center hide-on-tablet" v-else >?</td>
                                <td v-if="stack.report_id == null" class="text-right">{{ stack.current_chips.toLocaleString() }} </td>
                                <td v-else class="text-right">{{ stack.current_chips === 0 ? 'BUSTED': stack.current_chips.toLocaleString()}}</td>
                                <td v-if="stack.report_id == null" class="text-right"><i class="fa fa-whatsapp"> </i> whatsapp </td>
                                <td v-else class="text-right hide-on-mobile" >{{ stack.current_chips === 0 ? '':stack.changes.toLocaleString() }} 
                                    <span v-if="stack.symbol === 'up'" style="margin-left: 10px;"><i v-if="stack.current_chips != 0" class="fa-sharp fa-solid fa-caret-up text-green"></i></span>
                                    <span v-else style="margin-left: 10px;" ><i v-if="stack.current_chips != 0" class="fa-sharp fa-solid fa-caret-down text-red"></i></span>
                                </td>
                            </tr>
                        </template>
                    </CustomeTable>
                </div>
            </div>
            <div v-show="tab == 2">
                <div class="margin-top">
                    <vue-picture-swipe :items="items" style="position: relative; padding-bottom: 100%; display: flex; flex-wrap: wrap; gap: 10px;"></vue-picture-swipe>
                </div>
            </div>
            <div v-show="tab == 3">
                <div class="margin-top">
                    <CustomeTable v-if="event?.payouts?.length">
                        <template v-slot:table-head>
                            <tr class="text-primary">
                                <th class="text-center">Place</th>
                                <th>Name</th>
                                <th class="text-center hide-on-mobile">Country</th>
                                <th class="text-right">Prize (<span v-html="event.currency.prefix"> </span>)</th>
                            </tr>
                        </template>
                        <template v-slot:table-body>
                            <tr v-for="payout in event.payouts" :key="payout.player">
                                <td class="text-center">{{payout.position}}</td>
                                <td> <span style="white-space: nowrap;">{{payout.player?.name}} </span> </td>
                                <td class="text-center hide-on-mobile"><CountryFlag :title="payout.player?.country?.full_name" :iso="payout.player?.country?.iso_3166_2" /></td>
                                <td class="text-right"> <span v-html="event.currency.prefix"> </span> {{Number(payout.prize).toLocaleString() }}</td>
                            </tr>
                        </template>
                    </CustomeTable>
                </div>
            </div>
            <div v-show="tab == 4">
                <div class="margin-top">
                    {{event.whatsapp}}
                    <p>Whatsapp</p>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { ref, computed } from "@vue/reactivity";
import { onMounted, watch } from "@vue/runtime-core";
import CustomeTable from '../CustomeTable.vue'
import CountryFlag from 'vue3-country-flag-icon'
import VuePictureSwipe from 'vue3-picture-swipe'
import defaultAvatar from '@/default-avatar.png'


import brokenMirror from '@/photo_templates/brokenmirror.png'
import bulletHole from '@/photo_templates/bullethole.png'
import flames from '@/photo_templates/flames.png'
import happyBirthday from '@/photo_templates/happybirthday.png'
import iceCubes from '@/photo_templates/icecubes.png'
import pocketAces from '@/photo_templates/pocketaces.png'
import sunRays from '@/photo_templates/sunrays.png'
import waterLeaves from '@/photo_templates/water-leaves.png'
import waterWaves from '@/photo_templates/water-waves.png'

// components
import EachReport from './EachReport.vue'

const props = defineProps({
    reports : {
      type: Object,
    },
    event: {
        type: Object
    }
});

    const groupedReports = computed(() => {
        const levels = [... new Set(props.reports.map(report => report.level.name))];
        const testObj = {}
        const levelObj = levels.map(level => testObj[level] = []);
        const groupedLevels = props.reports.map(report => {
            testObj[report.level.name].push(report);
        })
        return testObj;
    });

    const items = ref([]);

    const newReport = ref(null)

    onMounted( async () => {
        items.value = [];
        lastLevel.value = ''
    })
    watch(()=> props.event, ()=> {
        if(props.event) {
            props.event.gallery.forEach(element => {
                items.value.push({
                    thumbnail: element.thumbnail,
                    src: element.main,
                    w: 600,
                    h: 400,
                });
            });
        }
    })

const tab = ref(0);

const lastLevel = ref('')

const changeTab = (currentTab) => {
    tab.value = currentTab
}

/* FRAMES */
function getFrame(theme) {
    switch (theme) {
        case 'brokenMirror':
            return brokenMirror;
        case 'bulletHole':
            return bulletHole;
        case 'flames':
            return flames;
        case 'happyBirthday':
            return happyBirthday;
        case 'iceCubes':
            return iceCubes;
        case 'pocketAces':
            return pocketAces;
        case 'sunRays':
            return sunRays;
        case 'waterLeaves':
            return waterLeaves;
        case 'waterWaves':
            return waterWaves;
    }
}
</script>

<style scoped>
:deep(.gallery-thumbnail a img) {
    margin-bottom: 10px;
}

.text-secondary {
    color: #2d3436;
}

.text-green {
    color: #2ecc71;
}

.text-red {
    color: #e74c3c;
}

.single-post-box .about-more-autor ul.nav-tabs {
    margin-bottom:20px; 
}

.single-post-box .post-tags-box ul.tags-box li a {
    margin: 0px 10px 10px 0px;
}

.imageFrame {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.each-post {
    border-top: 1px solid #d3d3d3;
    border-bottom: 1px solid #d3d3d3;
}

.margin-bottom{
    margin-bottom: 20px;
}

.margin-top {
    margin-top: 20px;
}

ul.post-tags li .facebook {
    background-color: unset;
    margin-right: unset;
}

ul.post-tags li .twitter {
    background-color: unset;
}

.twitter i {
    margin-right: 1px;
}

.facebook i {
    margin-right: 1px;
}

.whatsapp {
    background-color: unset;

    margin-right: unset;
    margin-left: unset;
}

.single-post-box .post-tags-box {
    padding: unset  ;
}

@media(min-width:768px) {
    .post-content-min-height {
        min-height: 200px;
    }

     .show-on-mobile {
        display: none;
    }
}


@media(min-width:992px) {
    .post-content-min-height {
        min-height: 270px;
    }
}

@media(min-width:1200px) {
    .post-content-min-height {
        min-height: 320px;
    }
}

</style>