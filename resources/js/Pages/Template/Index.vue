<template>
    <Head>
        <title>This is a dynamic inertia</title>
        <meta property="og:image" name="test" />
        <meta property="og:image" name="test" />
    </Head>
    <FrontLayout title="kurik">
        <div class="block-content">
            <div class="title-section">
                <h1><span>{{page.title}}</span></h1>
            </div>
            <div class="single-post-box">
                <div v-html="page.content" class="post-content" style="white-wrap: wrap; word-wrap: break-word;"></div>
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>


import { Head, Link, usePage } from '@inertiajs/inertia-vue3';

import FrontLayout from '@/Layouts/FrontLayout.vue';
import ReportList from '../../Components/Frontend/Report/ReportList.vue';
import SideBar from '../../Components/Frontend/MainContent/SideBar.vue';
import TournamentList from '../../Components/Frontend/Tournament/List.vue';

import { useArticleStore } from '@/stores/article.js'
import { onMounted, ref, watch } from '@vue/runtime-core';

const articleStore = useArticleStore()

const list = ref([])

const props = defineProps({
    page : {
        type: Object,
        default: {},
    },
});

</script>

<style scoped>

:deep(.post-content p) {

  padding:unset !important;

}


</style>