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

        <div class="widget social-widget">
            <div class="title-section">
                <h1><span>Twitter</span></h1>
            </div>

            <div class="single-post-box">
                <div class="news-post article-post custom-article">
                    <blockquote data-cards="hidden" class="twitter-tweet">
                        <p lang="en" dir="ltr">
                            A successful week for the Life of Poker team.
                            Congratulating Thijs Hilberts with his 3-way deal in
                            the Main Event.
                            <a
                                href="https://twitter.com/hashtag/lifeofpoker?src=hash&amp;ref_src=twsrc%5Etfw"
                                >#lifeofpoker</a
                            >
                            <a
                                href="https://twitter.com/hashtag/poker?src=hash&amp;ref_src=twsrc%5Etfw"
                                >#poker</a
                            >
                            <a
                                href="https://twitter.com/hashtag/appt?src=hash&amp;ref_src=twsrc%5Etfw"
                                >#appt</a
                            >
                            <a
                                href="https://twitter.com/hashtag/okada?src=hash&amp;ref_src=twsrc%5Etfw"
                                >#okada</a
                            >
                            <a href="https://t.co/YAW6Lm67qj"
                                >pic.twitter.com/YAW6Lm67qj</a
                            >
                        </p>
                        &mdash; LifeofPoker (@Life_of_Poker)
                        <a
                            href="https://twitter.com/Life_of_Poker/status/1558285149208358912?ref_src=twsrc%5Etfw"
                            >August 13, 2022</a
                        >
                    </blockquote>
                    <blockquote data-cards="hidden" class="twitter-tweet">
                        <p lang="en" dir="ltr">
                            Down to 50 players in the APPT Kickoff. Follow the
                            action here⬇️<a href="https://t.co/Zg9rL2WQFn"
                                >https://t.co/Zg9rL2WQFn</a
                            >
                            <a href="https://t.co/cvfkJ2jaZc"
                                >pic.twitter.com/cvfkJ2jaZc</a
                            >
                        </p>
                        &mdash; LifeofPoker (@Life_of_Poker)
                        <a
                            href="https://twitter.com/Life_of_Poker/status/1553659609788739584?ref_src=twsrc%5Etfw"
                            >July 31, 2022</a
                        >
                    </blockquote>
                </div>
            </div>
        </div>

        <div class="widget social-widget">
            <div class="title-section">
                <h1><span>Instagram</span></h1>
            </div>

            <div class="single-post-box">
                <div class="news-post article-post custom-article">
                    <blockquote
                        class="instagram-media"
                        data-instgrm-permalink="https://www.instagram.com/p/B00ceH7pcYY/?utm_source=ig_embed&amp;utm_campaign=loading"
                        data-instgrm-version="14"
                        style="
                            background: #fff;
                            border: 0;
                            border-radius: 3px;
                            box-shadow: 0 0 1px 0 rgba(0, 0, 0, 0.5),
                                0 1px 10px 0 rgba(0, 0, 0, 0.15);
                            margin: 1px;
                            max-width: 540px;
                            min-width: 260px;
                            padding: 0;
                            width: 99.375%;
                            width: -webkit-calc(100% - 2px);
                            width: calc(100% - 2px);
                        "
                    >
                        <div style="padding: 16px">
                            <a
                                href="https://www.instagram.com/p/B00ceH7pcYY/?utm_source=ig_embed&amp;utm_campaign=loading"
                                style="
                                    background: #ffffff;
                                    line-height: 0;
                                    padding: 0 0;
                                    text-align: center;
                                    text-decoration: none;
                                    width: 100%;
                                "
                                target="_blank"
                            >
                                <div
                                    style="
                                        display: flex;
                                        flex-direction: row;
                                        align-items: center;
                                    "
                                >
                                    <div
                                        style="
                                            background-color: #f4f4f4;
                                            border-radius: 50%;
                                            flex-grow: 0;
                                            height: 40px;
                                            margin-right: 14px;
                                            width: 40px;
                                        "
                                    ></div>
                                    <div
                                        style="
                                            display: flex;
                                            flex-direction: column;
                                            flex-grow: 1;
                                            justify-content: center;
                                        "
                                    >
                                        <div
                                            style="
                                                background-color: #f4f4f4;
                                                border-radius: 4px;
                                                flex-grow: 0;
                                                height: 14px;
                                                margin-bottom: 6px;
                                                width: 100px;
                                            "
                                        ></div>
                                        <div
                                            style="
                                                background-color: #f4f4f4;
                                                border-radius: 4px;
                                                flex-grow: 0;
                                                height: 14px;
                                                width: 60px;
                                            "
                                        ></div>
                                    </div>
                                </div>
                                <div style="padding: 19% 0"></div>
                                <div
                                    style="
                                        display: block;
                                        height: 50px;
                                        margin: 0 auto 12px;
                                        width: 50px;
                                    "
                                >
                                    <svg
                                        width="50px"
                                        height="50px"
                                        viewBox="0 0 60 60"
                                        version="1.1"
                                        xmlns="https://www.w3.org/2000/svg"
                                        xmlns:xlink="https://www.w3.org/1999/xlink"
                                    >
                                        <g
                                            stroke="none"
                                            stroke-width="1"
                                            fill="none"
                                            fill-rule="evenodd"
                                        >
                                            <g
                                                transform="translate(-511.000000, -20.000000)"
                                                fill="#000000"
                                            >
                                                <g>
                                                    <path
                                                        d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"
                                                    ></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div style="padding-top: 8px">
                                    <div
                                        style="
                                            color: #3897f0;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            font-style: normal;
                                            font-weight: 550;
                                            line-height: 18px;
                                        "
                                    >
                                        View this post on Instagram
                                    </div>
                                </div>
                                <div style="padding: 12.5% 0"></div>
                                <div
                                    style="
                                        display: flex;
                                        flex-direction: row;
                                        margin-bottom: 14px;
                                        align-items: center;
                                    "
                                >
                                    <div>
                                        <div
                                            style="
                                                background-color: #f4f4f4;
                                                border-radius: 50%;
                                                height: 12.5px;
                                                width: 12.5px;
                                                transform: translateX(0px)
                                                    translateY(7px);
                                            "
                                        ></div>
                                        <div
                                            style="
                                                background-color: #f4f4f4;
                                                height: 12.5px;
                                                transform: rotate(-45deg)
                                                    translateX(3px)
                                                    translateY(1px);
                                                width: 12.5px;
                                                flex-grow: 0;
                                                margin-right: 14px;
                                                margin-left: 2px;
                                            "
                                        ></div>
                                        <div
                                            style="
                                                background-color: #f4f4f4;
                                                border-radius: 50%;
                                                height: 12.5px;
                                                width: 12.5px;
                                                transform: translateX(9px)
                                                    translateY(-18px);
                                            "
                                        ></div>
                                    </div>
                                    <div style="margin-left: 8px">
                                        <div
                                            style="
                                                background-color: #f4f4f4;
                                                border-radius: 50%;
                                                flex-grow: 0;
                                                height: 20px;
                                                width: 20px;
                                            "
                                        ></div>
                                        <div
                                            style="
                                                width: 0;
                                                height: 0;
                                                border-top: 2px solid
                                                    transparent;
                                                border-left: 6px solid #f4f4f4;
                                                border-bottom: 2px solid
                                                    transparent;
                                                transform: translateX(16px)
                                                    translateY(-4px)
                                                    rotate(30deg);
                                            "
                                        ></div>
                                    </div>
                                    <div style="margin-left: auto">
                                        <div
                                            style="
                                                width: 0px;
                                                border-top: 8px solid #f4f4f4;
                                                border-right: 8px solid
                                                    transparent;
                                                transform: translateY(16px);
                                            "
                                        ></div>
                                        <div
                                            style="
                                                background-color: #f4f4f4;
                                                flex-grow: 0;
                                                height: 12px;
                                                width: 16px;
                                                transform: translateY(-4px);
                                            "
                                        ></div>
                                        <div
                                            style="
                                                width: 0;
                                                height: 0;
                                                border-top: 8px solid #f4f4f4;
                                                border-left: 8px solid
                                                    transparent;
                                                transform: translateY(-4px)
                                                    translateX(8px);
                                            "
                                        ></div>
                                    </div>
                                </div>
                                <div
                                    style="
                                        display: flex;
                                        flex-direction: column;
                                        flex-grow: 1;
                                        justify-content: center;
                                        margin-bottom: 24px;
                                    "
                                >
                                    <div
                                        style="
                                            background-color: #f4f4f4;
                                            border-radius: 4px;
                                            flex-grow: 0;
                                            height: 14px;
                                            margin-bottom: 6px;
                                            width: 224px;
                                        "
                                    ></div>
                                    <div
                                        style="
                                            background-color: #f4f4f4;
                                            border-radius: 4px;
                                            flex-grow: 0;
                                            height: 14px;
                                            width: 144px;
                                        "
                                    ></div></div
                            ></a>
                            <p
                                style="
                                    color: #c9c8cd;
                                    font-family: Arial, sans-serif;
                                    font-size: 14px;
                                    line-height: 17px;
                                    margin-bottom: 0;
                                    margin-top: 8px;
                                    overflow: hidden;
                                    padding: 8px 0 7px;
                                    text-align: center;
                                    text-overflow: ellipsis;
                                    white-space: nowrap;
                                "
                            >
                                <a
                                    href="https://www.instagram.com/p/B00ceH7pcYY/?utm_source=ig_embed&amp;utm_campaign=loading"
                                    style="
                                        color: #c9c8cd;
                                        font-family: Arial, sans-serif;
                                        font-size: 14px;
                                        font-style: normal;
                                        font-weight: normal;
                                        line-height: 17px;
                                        text-decoration: none;
                                    "
                                    target="_blank"
                                    >A post shared by Life of Poker
                                    (@lifeofpoker_com)</a
                                >
                            </p>
                        </div>
                    </blockquote>
                </div>
            </div>
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
