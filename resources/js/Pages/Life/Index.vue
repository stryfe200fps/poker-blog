<template> 
<Head>
  <title>This is a dynamic inertia</title>
  <meta property="og:image" name="test" /> 
  <meta property="og:image" name="test" /> 
</Head>

      <FrontLayout title="kurik">
  
        <div class="block-content">
          <div class="title-section">
              <h1><span>Article page</span></h1>
          </div>
          <div class="latest-articles iso-call" style="opacity: 1; position: relative; height: 1241.02px;">
            <div class="news-post standard-post3 default-size" style="position: absolute; left: 0px; top: 0px;" >
              <div class="post-gallery">
                <img src="upload/news-posts/7.jpg" alt="">
              </div>
              <div class="post-title">
                <a class="category-post tech" href="tech.html">tech</a>
                <h2><a href="single-post.html">Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. </a></h2>
                <ul class="post-tags">
                  <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                  <li><i class="fa fa-user"></i>by <a href="#">John Doe</a></li>
                  <li><a href="#"><i class="fa fa-comments-o"></i><span>23</span></a></li>
                </ul>
              </div>
            </div>
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

import { useArticleStore } from '@/Stores/article.js'
import { onMounted, ref, watch } from '@vue/runtime-core';


</script>