<template>
    <Head>
        <title>This is a dynamic inertia</title>
        <meta property="og:image" name="test" />
        <meta property="og:image" name="test" />
    </Head>
    <FrontLayout title="kurik">
        <div class="block-content">
            <div class="contact-info-box">
                <div class="title-section">
                    <h1>
                        <span>{{ page.title }}</span>
                    </h1>
                </div>
                <div class="single-post-box">
                    <div
                        v-html="page.content"
                        class="post-content"
                        style="white-wrap: wrap; word-wrap: break-word"
                    ></div>
                </div>
            </div>
            <div class="contact-form-box" v-if="page.slug === 'contact'">
                <div class="title-section">
                    <h1><span>Talk to us</span></h1>
                </div>
                <form id="contact-form">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Name*</label>
                            <input id="name" name="name" type="text" />
                        </div>
                        <div class="col-md-4">
                            <label for="mail">E-mail*</label>
                            <input id="mail" name="mail" type="text" />
                        </div>
                        <div class="col-md-4">
                            <label for="subject">Subject*</label>
                            <select
                                name="subject"
                                id="subject"
                                class="contact-subject"
                            >
                                <option selected disabled>
                                    Select Subject
                                </option>
                                <option value="General Inquiry">
                                    General Inquiry
                                </option>
                                <option value="Partnership Inquiry">
                                    Partnership Inquiry
                                </option>
                                <option value="Advertising Inquiry">
                                    Advertising Inquiry
                                </option>
                                <option value="Report mistakes">
                                    Report mistakes
                                </option>
                                <option value="Report Bug">Report Bug</option>
                                <option value="Report Violations">
                                    Report Violations
                                </option>
                            </select>
                        </div>
                    </div>
                    <label for="comment">Your Message*</label>
                    <textarea id="comment" name="comment"></textarea>
                    <button type="submit" id="submit-contact">
                        <i class="fa fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>
import { Head, Link, usePage } from "@inertiajs/inertia-vue3";

import FrontLayout from "@/Layouts/FrontLayout.vue";
import ReportList from "../../Components/Frontend/Report/ReportList.vue";
import SideBar from "../../Components/Frontend/MainContent/SideBar.vue";
import TournamentList from "../../Components/Frontend/Tournament/List.vue";

import { useArticleStore } from "@/stores/article.js";
import { onMounted, ref, watch } from "@vue/runtime-core";

const articleStore = useArticleStore();

const list = ref([]);

const props = defineProps({
    page: {
        type: Object,
        default: {},
    },
});
</script>

<style scoped>
:deep(.post-content p) {
    padding: unset !important;
}

.contact-subject {
    display: block;
    width: 100%;
    margin: 0 0 16px;
    padding: 10px 20px;
    font-size: 13px;
    font-family: "Lato", sans-serif;
    background-color: #fafafa;
    color: #333333;
    outline: none;
    border: 1px solid #e1e1e1;
    transition: all 0.2s ease-in-out;
}
</style>
