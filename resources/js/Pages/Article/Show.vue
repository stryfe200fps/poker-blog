<template>
    <FrontLayout title="">
        <Head>
            <title>{{ article.title }}</title>
            <meta name="description" content="Your page description" />
            <meta property="og:title=" :content="article.title" />
            <meta property="og:description" :content="article.body" />
        </Head>

        <!-- {{ getArticle(slug) }} -->
        <div class="block-content" >
            <div class="title-section">
                <Link onclick="history.back();return false;" ><h1 class="text-primary"><span><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</span></h1></Link>
            </div>

            <div class="">
                <div class="single-post-box">
                    
                    <div class="title-post">
                        <h1>{{article.title}}</h1>
                        <div style="display:flex; justify-content: space-between;">
                            <div>
                                <ul class="post-tags">
                                    <li><i class="fa fa-clock-o"></i>{{article.date}}</li>
                                    <li><i class="fa fa-user"></i>by <a href="#">{{ article.author }}
                                            </a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <ul class="post-tags share-post-links">
                                    <li style="margin-left: 2px;">
                                        <i class="fa fa-share-alt text-secondary"></i><span class="text-secondary">Share <span class="hide-on-smallest">Post</span></span>
                                    </li>
                                    <li ><a target="_blank" :href="'https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Farticle%2Fshow%2F' + article.slug + '&amp;src=sdkpreparse'"  class="facebook"><i
                                                class="fa fa-facebook text-secondary"></i></a>
                                    </li>
                                    <li><a target="_blank" :href="'https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/article/show/' + article.slug" class="twitter"><i
                                                class="fa fa-twitter text-secondary"></i></a>
                                    </li>
                                    <li><a target="_blank" :href="'https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/article/show/' + article.slug" class="whatsapp"><i
                                                class="fa fa-whatsapp text-secondary"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div :class="article.main_image ? 'post-content-min-height' : '' "  class="post-content">
                        <div v-if="article.main_image" class="post-gallery float-img"
                            style="float: left; margin: 0px 15px 5px 0px;">
                            <img :src="article.main_image" alt="">
                            <span class="image-caption">{{article.caption}}</span>
                        </div>
                        <div class="remove-padding" v-html="article.body"></div>
                    </div>

                    <div class="post-tags-box">
                        <ul class="tags-box">
                            <li><i class="fa fa-tags"></i><span>Tags:</span></li>
                            <li><a href="#">News</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Politics</a></li>
                            <li><a href="#">Sport</a></li>
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

import { useArticleStore } from '@/stores/article.js'
import { onMounted, ref, watch } from '@vue/runtime-core';

const articleStore = useArticleStore()

const props = defineProps({
    slug : {
      type: String,
      default: ''
    }
});


const article = ref([])

onMounted(async() => {
    await  articleStore.getList()
    usePage().props.value = '20'
});

watch(
  () => articleStore.list,
  function () {
  article.value = articleStore.getArticleBySlug(props.slug)
  
  }
);


</script>



<style scoped>
:deep(.remove-padding p) {
    padding-left: unset;
}

ul.post-tags {
    margin-left: 2px;
}

.single-post-box .post-tags-box {
    margin-bottom: unset;
    border-bottom: 1px solid #d3d3d3;
    padding: 0 20px;
}

.single-post-box .post-tags-box ul.tags-box li {
    margin-right: 8px;
    margin-bottom: 8px;
}

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