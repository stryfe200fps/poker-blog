<template> 
<Head>
  <title>This is a dynamic inertia</title>
  <meta property="og:image" name="test" /> 
  <meta property="og:image" name="test" /> 
</Head>

    <FrontLayout title="kurik">
        <div class="block-content">
            <!-- single-post box -->
            <div class="single-post-box">
                <div class="title-post">
                    <h1>{{page.title}}</h1>
                </div>
                
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

const props = defineProps({
    page: {
    type : Object,
        default : {}
    }

});

const list = ref([])

</script>

<style scoped>
.post-content p {
    white-space: wrap; 
    word-wrap: break-word;
}
</style>