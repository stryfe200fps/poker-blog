<template>
    <div class="single-post-box">
        <div class="title-post"  style="border-top: 1px solid #d3d3d3; padding-top: 20px;">
            <h1><Link class="default-text-color" :href="`/report/${item.slug}`">{{ item.title }}</Link></h1>
            <div style="display:flex; justify-content: space-between;">
                <div>
                    <ul class="post-tags">
                        <li><i class="fa fa-clock-o"></i>{{item.isFinished ? getDate(item.date_added):item.formattedDate}}</li>
                        <li><i class="fa fa-user"></i>by <a href="#">{{item.author?.first_name}} {{item.author?.last_name}}</a> - {{item.level.name}}
                        </li>
                    </ul>
                </div>
                <div>
                    <ul class="post-tags share-post-links">
                        <li class="text-secondary"><i class="fa fa-share-alt text-secondary"></i><span>Share
                                Post</span>
                        </li>
                       <li ><a target="_blank" :href="'https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Freport%2F' + item.slug + '&amp;src=sdkpreparse'"  class="facebook"><i
                                            class="fa fa-facebook text-secondary"></i></a>
                                </li>
                                <li><a target="_blank" :href="'https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/report/' + item.slug" class="twitter"><i
                                            class="fa fa-twitter text-secondary"></i></a>
                                </li>
                            <li><a target="_blank" :href="'https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/report/' + item.slug" class="whatsapp"><i
                                            class="fa fa-whatsapp text-secondary"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div :class="item?.main_image  ? 'post-content-min-height' : ''" class="post-content">
            <div class="post-gallery float-img" v-if="item.main_image"
                style="float: left; margin: 0px 15px 5px 0px;">
                <div style="position: relative;">
                    <img :src="item.main_image" alt="" style="margin-bottom: unset;" :style="[item.theme ? { 'filter': 'brightness(0.8)' } : {}]">
                    <div class="imageFrame" :style="{ 'background-image': 'url(' + getFrame(item.theme) + ')' }"></div>
                </div>
                <span v-if="item.caption" class="image-caption">{{item.caption}}</span>
            </div>
            <div class="remove-padding" v-html="item.content"></div>
        </div>

        <div v-if="item.event_chips">
            <CustomeTable>
                <template v-slot:table-body>
                    <tr v-for="(item, index) in item.event_chips" :key="index" >
                        
                        <td v-if="item.player?.name != null">
                            <img class="hide-on-mobile" v-if="item.player?.avatar" :src="item.player?.avatar" />
                            <img class="hide-on-mobile" v-else :src="defaultAvatar" />
                            {{ item.player?.name }}
                            <span style="white-space: nowrap;"></span>
                        </td>
                        <td  class="text-center hide-on-tablet" v-if=" item.player?.name != null && item.player?.country"><CountryFlag :title="item.player?.country?.name" :iso="item.player?.country?.iso_3166_2" /></td>
                        <td  class="text-center hide-on-tablet" v-else ></td>
                        <td v-if="item.player?.name != null" class="text-right">{{ item.current_chips === 0 ? 'BUSTED': item.current_chips.toLocaleString()}}</td>
                        <td v-if="item.player?.name != null" class="text-right hide-on-mobile" >{{ item.current_chips === 0 ? '':item.changes.toLocaleString() }} 
                            <span v-if="item.symbol === 'up'" style="margin-left: 10px;"><i v-if="item.current_chips != 0" class="fa-sharp fa-solid fa-caret-up text-green"></i></span>
                            <span v-else style="margin-left: 10px;" ><i v-if="item.current_chips != 0" class="fa-sharp fa-solid fa-caret-down text-red"></i></span>
                        </td>
                    </tr>
                </template>
            </CustomeTable>
        </div>

        <div class="post-tags-box margin-top " v-if="item.event_chips.length">
            <ul class="tags-box">
                <li><i class="fa fa-tags"></i><span>Tags:</span><a href="#" v-for="tag in item.event_chips" :key="tag.id">{{tag?.player?.name}}</a></li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
import CustomeTable from '../CustomeTable.vue';
import CountryFlag from 'vue3-country-flag-icon';
import VuePictureSwipe from 'vue3-picture-swipe';
import defaultAvatar from '@/default-avatar.png';
import moment from 'moment';

import brokenMirror from '@/photo_templates/brokenmirror.png'
import bulletHole from '@/photo_templates/bullethole.png'
import flames from '@/photo_templates/flames.png'
import happyBirthday from '@/photo_templates/happybirthday.png'
import iceCubes from '@/photo_templates/icecubes.png'
import pocketAces from '@/photo_templates/pocketaces.png'
import sunRays from '@/photo_templates/sunrays.png'
import waterLeaves from '@/photo_templates/water-leaves.png'
import waterWaves from '@/photo_templates/water-waves.png'


const props = defineProps({
    item : {
      type: Object,
    }
});

const items = ref([]);

const getDate = (date) => {
    let eventEndDate = props.item.event.date_end;
    let dateNow = moment().format('MMM D YYYY');
    if (dateNow > eventEndDate) return (moment(date).format('MMM DD YYYY'))
    return(moment(date).fromNow());
}

const newItem = ref(null)

onMounted(async ()=> {
    lastLevel.value = ''

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
:deep(.remove-padding p) {
    padding-left: unset;
}

.single-post-box .post-tags-box ul.tags-box li a {
    margin-right: 8px;
    margin-bottom: 8px;
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

.single-post-box .post-tags-box {
    margin-left: 20px;
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