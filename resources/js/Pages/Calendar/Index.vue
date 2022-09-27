<template> 
<Head>
  <title>Event Calendar</title>
  <meta property="og:image" name="test" /> 
  <meta property="og:image" name="test" /> 
</Head>

      <FrontLayout title="kurik">
  
        <div class="block-content">
          <div class="title-section">
              <h1><span>Event Calendar</span></h1>
          </div>
          <div class="latest-articles iso-call" style="opacity: 1; position: relative; height: 1241.02px;">
          
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


</script>