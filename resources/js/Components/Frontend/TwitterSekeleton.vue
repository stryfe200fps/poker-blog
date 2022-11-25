<template>
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

<style scoped>
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
</style>
