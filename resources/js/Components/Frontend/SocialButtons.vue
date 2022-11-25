<template>
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
                    ><i class="fa-brands fa-instagram social-share__icon"></i
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
                    ><i class="fa-brands fa-youtube social-share__icon"></i
                    >Youtube</span
                ></a
            >
        </li>
    </ul>
</template>

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
</style>
