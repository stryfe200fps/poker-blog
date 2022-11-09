<script setup>
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { ref, computed } from "@vue/runtime-core";
import { createToast } from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";
import moment from "moment";

const email = ref(null);

const currentDate = computed(() => {
    return moment().format("YYYY");
});

async function submitEmail() {
    try {
        await axios.post("api/subscribe", {
            email: email.value,
        });
        email.value = null;
        createToast("Thank you for subscribing.", {
            position: "top-center",
            hideProgressBar: true,
            type: "success",
            transition: "slide",
            timeout: 2000,
            showIcon: true,
            showCloseButton: true,
        });
    } catch (error) {
        console.error(error);
    }
}
</script>

<template>
    <footer style="position: relative; background-color: #2d3436">
        <div class="container">
            <div class="footer-widgets-part">
                <div class="row">
                    <div class="col-md-4">
                        <div class="widget text-widget">
                            <h1 style="color: white; border-color: #999">
                                About Us
                            </h1>
                            <p>
                                Life of poker is a one stop shop for all your
                                poker needs. We are here to bring the action to
                                your doorstep. Live event coverage, interviews,
                                videos, podcasts and much more.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget social-widget">
                            <h1 style="color: white; border-color: #999">
                                Stay Connected
                            </h1>
                            <ul class="social-icons">
                                <li>
                                    <a
                                        href="https://www.facebook.com/profile.php?id=100083369017397"
                                        target="_blank"
                                        class="facebook"
                                        style="border: none"
                                        ><i class="fa fa-facebook"></i
                                    ></a>
                                </li>
                                <li>
                                    <a
                                        href="https://twitter.com/Life_of_Poker"
                                        target="_blank"
                                        class="twitter"
                                        style="border: none"
                                        ><i class="fa fa-twitter"></i
                                    ></a>
                                </li>
                                <li>
                                    <a
                                        href="https://www.instagram.com/lifeofpoker_com/"
                                        target="_blank"
                                        class="instagram"
                                        style="border: none"
                                        ><i class="fa-brands fa-instagram"></i
                                    ></a>
                                </li>
                                <li>
                                    <a
                                        href="https://www.youtube.com/channel/UCbBvulSR2T9y2vTtcKglXUg"
                                        target="_blank"
                                        class="youtube"
                                        style="border: none"
                                        ><i class="fa-brands fa-youtube"></i
                                    ></a>
                                </li>
                                <!-- <li>
                                    <a href="#" class="whatsapp-hover"
                                        ><i class="fa-brands fa-whatsapp"></i
                                    ></a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="whatsapp-hover"
                                        style="border: none"
                                        ><i class="fa-brands fa-spotify"></i
                                    ></a>
                                </li> -->
                            </ul>
                        </div>
                        <div class="widget subscribe-widget">
                            <form
                                @submit.prevent="submitEmail"
                                class="subscribe-form"
                                style="padding: 0; background: none"
                            >
                                <h1>Subscribe and stay updated</h1>
                                <input
                                    type="email"
                                    v-model="email"
                                    placeholder="Email"
                                    class="subscribe-email"
                                    required
                                    style="padding-right: 4rem"
                                />
                                <button type="submit" style="background: none">
                                    <i
                                        class="fa fa-arrow-circle-right"
                                        style="color: red"
                                    ></i>
                                </button>
                                <p>
                                    Get all latest content delivered to your
                                    email a few times a month.
                                </p>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget categories-widget">
                            <h1 style="color: white; border-color: #999">
                                Help Center
                            </h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="category-list">
                                        <li>
                                            <Link href="/news"
                                                >News & Info</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/tournament"
                                                >Live Reporting</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/event-calendar"
                                                >Event Calendar</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/about">About Us</Link>
                                        </li>
                                        <li>
                                            <Link href="/contact">Contact</Link>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="category-list">
                                        <li>
                                            <Link href="/cookie"
                                                >Cookie Policy</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/acceptable-use"
                                                >Acceptable Use Policy</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/dmca"
                                                >DMCA Policy</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/guest-post"
                                                >Guest Post Policy</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/refund"
                                                >Refund Policy</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/responsible-gambling"
                                                >Responsible Gambling</Link
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-last-line">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            &copy; 2021-{{ currentDate }} Life of poker. All
                            rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <nav class="footer-nav">
                            <ul>
                                <li>
                                    <Link href="/terms"
                                        >Terms & Conditions</Link
                                    >
                                </li>
                                <li>
                                    <Link href="/privacy">Privacy Policy</Link>
                                </li>
                                <li>
                                    <Link href="/disclaimer">Disclaimer</Link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>
footer .social-widget ul.social-icons li a.instagram:hover {
    background: linear-gradient(
        45deg,
        #f09433 0%,
        #e6683c 25%,
        #dc2743 50%,
        #cc2366 75%,
        #bc1888 100%
    ) !important;
}
footer .social-widget ul.social-icons li a.whatsapp-hover:hover {
    background: #2ecc71 !important;
}

/* footer .social-widget ul.social-icons li {
    margin-right: 30px;
} */

footer .social-widget ul.social-icons li a {
    border: 1px solid #333333;
}

footer .categories-widget ul.category-list li a {
    padding: 0;
}

.subscribe-email {
    display: block;
    width: 100%;
    padding: 12px;
    font-size: 12px;
    font-family: "Lato", sans-serif;
    background-color: #fafafa;
    color: #333;
    outline: none;
    border: none;
    transition: all 0.2s ease-in-out;
}

footer .categories-widget ul.category-list li:nth-child(2n) {
    padding-left: 0;
}

footer .categories-widget ul.category-list li {
    width: auto;
    float: none;
}
</style>
