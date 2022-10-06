<template>
    <div class="sidebar">
        <div class="widget social-widget">
            <div class="title-section">
                <h1><span>Stay Connected</span></h1>
            </div>
            <ul class="social-share">
                <li>
                    <a
                        class="social-share__btn facebook"
                        href="https://www.facebook.com/profile.php?id=100083369017397"
                        target="_blank"
                        ><span class="social-share__btn-text"
                            ><i class="fa fa-facebook social-share__icon"></i
                            >Facebook</span
                        ></a
                    >
                </li>
                <li>
                    <a
                        class="social-share__btn instagram"
                        href="https://www.instagram.com/lifeofpoker_com/"
                        target="_blank"
                        ><span class="social-share__btn-text"
                            ><i
                                class="fa-brands fa-instagram social-share__icon"
                            ></i
                            >Instagram</span
                        ></a
                    >
                </li>
                <li>
                    <a
                        class="social-share__btn twitter"
                        href="https://twitter.com/Life_of_Poker"
                        target="_blank"
                        ><span class="social-share__btn-text"
                            ><i class="fa fa-twitter social-share__icon"></i
                            >Twitter</span
                        ></a
                    >
                </li>
                <li>
                    <a
                        class="social-share__btn youtube"
                        href="https://www.youtube.com/channel/UCbBvulSR2T9y2vTtcKglXUg"
                        target="_blank"
                        ><span class="social-share__btn-text"
                            ><i
                                class="fa-brands fa-youtube social-share__icon"
                            ></i
                            >Youtube</span
                        ></a
                    >
                </li>
            </ul>
        </div>
        <div class="widget social-widget">
            <div class="title-section">
                <h1><span>twitter</span></h1>
            </div>
            <div
                class="news-post video-post"
                v-for="(tweet, index) in tweetIDs"
                :key="index"
            >
                <Tweet :tweet-id="tweet.id" cards="hidden" conversation="none">
                    <template v-slot:loading>
                        <div class="tweets-skeleton">
                            <div class="tweet-skeleton">
                                <div class="img"></div>
                                <div class="content-1">
                                    <div class="line"></div>
                                    <div class="line"></div>
                                    <div class="line"></div>
                                </div>
                                <div class="content-2">
                                    <div class="line"></div>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                    </template>
                </Tweet>
            </div>
        </div>
        <!-- <div class="widget social-widget">
            <div class="title-section">
                <h1>
                    <span>Instagram</span>
                </h1>
            </div>
            <div class="news-post article-post custom-article">
                <iframe
                    class="instagram-media instagram-media-rendered"
                    id="instagram-embed-0"
                    src="https://www.instagram.com/p/B00ceH7pcYY/embed/?cr=1&amp;v=14&amp;wp=261&amp;rd=https%3A%2F%2Fstaging.lifeofpoker.com&amp;rp=%2Fcontact#%7B%22ci%22%3A0%2C%22os%22%3A1047.2999999998137%2C%22ls%22%3A424.59999999962747%2C%22le%22%3A886%7D"
                    allowtransparency="true"
                    allowfullscreen="true"
                    frameborder="0"
                    height="466"
                    data-instgrm-payload-id="instagram-media-payload-0"
                    scrolling="no"
                    style="
                        background: white;
                        max-width: 540px;
                        width: calc(100% - 2px);
                        border-radius: 3px;
                        border: 1px solid rgb(219, 219, 219);
                        box-shadow: none;
                        display: block;
                        margin: 0px 0px 12px;
                        min-width: 326px;
                        padding: 0px;
                    "
                ></iframe>
            </div>
        </div> -->
        <div class="widget social-widget">
            <div class="title-section">
                <h1><span>instagram</span></h1>
            </div>
            <div class="news-post video-post"></div>
        </div>
    </div>
    <!-- <div class="sidebar">
        <div class="widget social-widget">
            <div class="title-section">
                <h1><span>Stay Connected</span></h1>
            </div>

            <div class="single-post-box">
                <div class="share-post-box" style="padding: 0">
                    <ul class="share-box share-box-button" style="">
                        <li style="width: 100%">
                            <a
                                class="facebook"
                                href="https://www.facebook.com/profile.php?id=100083369017397"
                                target="_blank"
                                style="width: 100%"
                                ><i class="fa fa-facebook"></i
                                ><span>Facebook</span></a
                            >
                        </li>
                        <li style="width: 100%">
                            <a
                                class="facebook"
                                href="https://www.instagram.com/lifeofpoker_com/"
                                target="_blank"
                                style="
                                    width: 100%;
                                    background: linear-gradient(
                                        45deg,
                                        #f09433 0%,
                                        #e6683c 25%,
                                        #dc2743 50%,
                                        #cc2366 75%,
                                        #bc1888 100%
                                    );
                                "
                                ><i class="fa-brands fa-instagram"></i
                                ><span>Instagram</span></a
                            >
                        </li>
                        <li style="width: 100%">
                            <a
                                class="twitter"
                                href="https://twitter.com/Life_of_Poker"
                                target="_blank"
                                style="width: 100%"
                                ><i class="fa fa-twitter"></i
                                ><span>Twitter</span></a
                            >
                        </li>
                        <li style="width: 100%">
                            <a
                                class="twitter"
                                href="https://www.youtube.com/channel/UCbBvulSR2T9y2vTtcKglXUg"
                                target="_blank"
                                style="width: 100%; background-color: #e74c3c"
                                ><i class="fa-brands fa-youtube"></i
                                ><span>Youtube</span></a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="widget features-slide-widget" v-if="eventStore.list">
            <div class="title-section">
                <h1><span>Events</span></h1>
            </div>
            <ul class="list-posts">
                <li
                    v-for="(event, index) in eventStore.list.data"
                    :key="event.id"
                >
                    <div v-if="index <= 4">
                        <img v-if="event.image" :src="event.image" />
                        <img
                            v-else
                            :src="defaultImg"
                            style="aspect-ratio: 3/3; background: #e7e7e7"
                        />
                        <div class="post-content">
                            <h2
                                class="post-content-link"
                                @click="navigateTo(event.id)"
                            >
                                {{ event.title }}
                            </h2>
                            <h2>
                                <router-link :to="`/live-report/${event.id}`">{{
                                    event.title
                                }}</router-link>
                            </h2>
                            <ul class="post-tags">
                                <li>
                                    <i class="fa fa-clock-o"></i
                                    >{{ event.date_start }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div> -->
</template>

<script setup>
import Tweet from "vue-tweet";
import { useTwitterStore } from "@/stores/twitter.js";
import { onMounted, ref, watch } from "@vue/runtime-core";

const twitterStore = useTwitterStore();
const tweetIDs = ref(null);

onMounted(async () => {
    await twitterStore.getTweetID();
});

watch(
    () => twitterStore.tweetIDs,
    function () {
        tweetIDs.value = twitterStore.tweetIDs.data;
    }
);
</script>

<style scoped>
.social-share__btn {
    width: 100% !important;
    padding: 12px 8px;
    border-radius: 5px;
}

.social-share__btn::after {
    border: 0 !important;
}

.social-share__icon {
    width: 1.2em;
    height: 1.2em;
    margin-right: 0.5em !important;
}

.social-share__btn-text {
    font-size: 14px !important;
    font-weight: 400 !important;
    color: #fff !important;
}

.instagram {
    background: linear-gradient(
        45deg,
        #f09433 0%,
        #e6683c 25%,
        #dc2743 50%,
        #cc2366 75%,
        #bc1888 100%
    );
}

.youtube {
    background-color: #e74c3c;
}

.tweets,
.tweets-skeleton {
    display: flex;
    justify-content: center;
    flex-flow: row wrap;
    width: 100%;
}

.tweet,
.tweet-skeleton {
    width: 100%;
}

.tweet-skeleton {
    height: 25rem;
    padding: 1.5rem;
    border: 0.05rem solid rgb(190, 190, 190);
    border-radius: 1rem;
}

.tweet-skeleton .img {
    width: 5rem;
    height: 5rem;
    background-color: rgb(209, 209, 209);
    border-radius: 50%;
    animation: tweet-skeleton 1s linear infinite alternate;
}

.tweet-skeleton .content-1,
.tweet-skeleton .content-2 {
    height: 45%;
    margin-top: 1rem;
}

.tweet-skeleton .line {
    width: 100%;
    height: 15%;
    margin: 0.5rem 0;
    background-color: rgb(209, 209, 209);
    border-radius: 0.3rem;
    animation: tweet-skeleton 1s linear infinite alternate;
}

.tweet-skeleton .line:last-child {
    width: 75%;
}

@keyframes tweet-skeleton {
    0% {
        background-color: rgb(209, 209, 209);
    }
    100% {
        background-color: rgb(243, 243, 243);
    }
}
/* .sidebar .widget {
    overflow: hidden;
}

.post-content-link {
    cursor: pointer;
}

.post-content-link:hover {
    color: #f44336 !important;
}

.single-post-box .share-post-box ul.share-box li a {
    display: flex;
    align-items: center;
    padding: 8px 2px 8px 3px;
}

.single-post-box .share-post-box ul.share-box li a i {
    width: 30px;
    text-align: center;
}

iframe {
    margin-left: calc(50% - 306px);
    margin-left: -webkit-calc(50% - 306px);
    margin-left: -moz-calc(50% - 306px);
}

@media only screen and (max-width: 612px) {
    iframe {
        margin-left: 0;
        width: 100%;
    }
} */
</style>
