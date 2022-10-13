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
        <div class="widget social-widget">
            <div class="title-section">
                <h1><span>instagram</span></h1>
            </div>
            <div class="news-post video-post">
                <div v-if="igFeed">
                    <iframe
                        :src="`${igLink}embed`"
                        width="320"
                        height="466"
                        allowtransparency="true"
                        allowfullscreen="true"
                        frameborder="0"
                        scrolling="no"
                        style="
                            width: 100%;
                            border: 0.05rem solid rgb(190, 190, 190);
                            border-radius: 5px;
                        "
                    ></iframe>
                </div>
                <div v-else class="tweets-skeleton">
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
            </div>
        </div>
    </div>
</template>

<script setup>
import Tweet from "vue-tweet";
import { useTwitterStore } from "@/Stores/twitter.js";
import { useIGStore } from "@/Stores/instagram.js";
import { computed, onMounted, ref, watch } from "@vue/runtime-core";

const twitterStore = useTwitterStore();
const tweetIDs = ref(null);
const igStore = useIGStore();
const igFeed = ref(null);

const igLink = computed(() => {
    return igFeed.value?.find((ig) => ig.permalink).permalink;
});

onMounted(async () => {
    await twitterStore.getTweetID();
    await igStore.getIGFeed();
});

watch(
    () => [twitterStore.tweetIDs, igStore.igFeed],
    function () {
        tweetIDs.value = twitterStore.tweetIDs.data;
        igFeed.value = igStore.igFeed?.data;
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
