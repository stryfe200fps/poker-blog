<template> 
<Head>
  <title>This is a dynamic inertia</title>
  <meta property="og:image" name="test" /> 
  <meta property="og:image" name="test" /> 
</Head>

    <FrontLayout title="kurik">
      <div class="block-content">

							<!-- grid box -->
        <div class="grid-box">
          <div class="title-section">
            <h1><span>News</span></h1>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="news-post standard-post2">

                <div class="post-gallery">
                  <img src="upload/news-posts/im7.jpg" alt="">
                  <a class="category-post world" href="world.html">Business</a>
                </div>

                <div class="post-title">
                  <h2><a href="single-post.html">Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. </a></h2>
                  <ul class="post-tags">
                    <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                    <li><i class="fa fa-user"></i>by <a href="#">John Doe</a></li>
                    <li><a href="#"><i class="fa fa-comments-o"></i><span>23</span></a></li>
                    <li><i class="fa fa-eye"></i>872</li>
                  </ul>
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="news-post standard-post2">
                <div class="post-gallery">
                  <img src="upload/news-posts/im8.jpg" alt="">
                  <a class="category-post world" href="world.html">Lifestyle</a>
                </div>

                <div class="post-title">
                  <h2><a href="single-post.html">Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. </a></h2>
                  <ul class="post-tags">
                    <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                    <li><i class="fa fa-user"></i>by <a href="#">John Doe</a></li>
                    <li><a href="#"><i class="fa fa-comments-o"></i><span>23</span></a></li>
                    <li><i class="fa fa-eye"></i>872</li>
                  </ul>
                </div>
              </div>
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

const articleStore = useArticleStore()

const list = ref([])

onMounted(async() => {
    await  articleStore.getList()
    usePage().props.value = '20'
});

watch(
  () => articleStore.list,
  function () {
  list.value = articleStore.list

  }
);

</script>