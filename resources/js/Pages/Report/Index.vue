<template>
    <!-- <Head>
  <title>This is a dynamic inertia</title>
  <meta property="og:image" name="test" /> 
  <meta property="og:image" name="test" /> 
</Head> -->

    <FrontLayout>
        <div class="block-content" v-if="1">
            <!-- <div class="block-content" v-if="list.data"> -->
            <div class="title-section hide-underline">
                <!-- <h1 class="text-primary"><span>{{list.data.poker_tournament}}</span></h1> -->
                <h1 class="text-primary"><span>Report</span></h1>
                <div style="display: flex; justify-content: space-between">
                    <h1><span>Report </span></h1>
                    <!-- <h1><span>{{list.data.title}}</span></h1> -->
                    <p>
                        <select style="padding: 4px 8px; outline: none">
                            <option>Day 1</option>
                        </select>
                    </p>
                </div>
            </div>
            <div class="single-post-box">
                <ReportList />
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";

import FrontLayout from "@/Layouts/FrontLayout.vue";
import ReportList from "../../Components/Frontend/Report/ReportList.vue";
import SideBar from "../../Components/Frontend/MainContent/SideBar.vue";
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

@media (min-width: 768px) {
    .post-content-min-height {
        min-height: 200px;
    }
}

@media (min-width: 992px) {
    .post-content-min-height {
        min-height: 250px;
    }
}

@media (min-width: 1200px) {
    .post-content-min-height {
        min-height: 300px;
    }
}
</style>
