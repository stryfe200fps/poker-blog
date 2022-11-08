<template>
    <Head>
        <title>{{ page.title }}</title>
    </Head>
    <FrontLayout>
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
            <div class="contact-form-box" v-if="page.template === 'contact'">
                <div class="title-section">
                    <h1><span>Talk to us</span></h1>
                </div>
                <form id="contact-form" @submit.prevent="submitMessage">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Name*</label>
                            <input type="text" v-model="name" required />
                        </div>
                        <div class="col-md-4">
                            <label for="mail">E-mail*</label>
                            <input
                                type="email"
                                class="contact-email"
                                v-model="email"
                                required
                            />
                        </div>
                        <div class="col-md-4">
                            <label for="subject">Subject*</label>
                            <select
                                class="contact-subject"
                                v-model="subject"
                                required
                            >
                                <option
                                    value=""
                                    :selected="subject === ''"
                                    disabled
                                >
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
                    <textarea v-model="message" required></textarea>
                    <button type="submit">
                        <i class="fa fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
            <div v-if="page.template === 'rooms'">
                <div class="grid-box filters">
                    <h4>Find poker rooms near me</h4>
                    <div>
                        <select class="form-control" v-model="selectedCountry">
                            <option value="" selected disabled>
                                Select Location
                            </option>
                            <option
                                v-for="(country, index) in countries"
                                :key="index"
                                :value="country.iso_3166_2"
                            >
                                {{ country.name }}
                            </option>
                        </select>
                    </div>
                    <button
                        class="btn btn-default"
                        v-if="selectedCountry !== ''"
                        @click="resetFilter()"
                    >
                        Reset
                    </button>
                </div>
                <div class="grid">
                    <PokerRooms
                        v-for="(room, index) in rooms"
                        :key="index"
                        :room="room"
                    />
                </div>
                <div
                    v-if="rooms?.length"
                    v-observe-visibility="handleScrolledToBottom"
                ></div>
            </div>
            <div v-if="page.template === 'videos'">
                <div class="grid-box filters">
                    <h4>Find media reports</h4>
                    <div>
                        <select class="form-control" v-model="selectedAuthor">
                            <option value="" selected disabled>
                                Select Authors
                            </option>
                            <option
                                v-for="(author, index) in authors"
                                :key="index"
                                :value="author.id"
                            >
                                {{ author.first_name }}
                            </option>
                        </select>
                    </div>
                    <button
                        class="btn btn-default"
                        v-if="selectedAuthor !== ''"
                        @click="resetFilter()"
                    >
                        Reset
                    </button>
                </div>
                <div class="grid">
                    <MediaReporting
                        v-for="(media, index) in medias"
                        :key="index"
                        :media="media"
                        :mediaType="
                            page.slug === 'podcast' ? 'podcast' : 'video'
                        "
                    />
                </div>
                <div
                    v-if="medias?.length"
                    v-observe-visibility="handleScrolledToBottomMedia"
                ></div>
            </div>
        </div>
    </FrontLayout>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { useRoomStore } from "@/Stores/pokerRoom.js";
import { useMediaStore } from "@/Stores/mediaReports.js";
import { onMounted, ref, computed, watch } from "@vue/runtime-core";
import axios from "axios";
import { createToast } from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";

import FrontLayout from "@/Layouts/FrontLayout.vue";
import PokerRooms from "./PokerRooms.vue";
import MediaReporting from "./MediaReporting.vue";

const name = ref(null);
const email = ref(null);
const subject = ref("");
const message = ref(null);
const countries = ref([]);
const selectedCountry = ref("");
const rooms = ref([]);
const medias = ref([]);
const authors = ref([]);
const selectedAuthor = ref("");
const currentPage = ref(1);
const lastPage = ref(1);
const pokerRoomStore = useRoomStore();
const mediaStore = useMediaStore();

const props = defineProps({
    page: {
        type: Object,
        default: {},
    },
});

const filteredLocation = computed(() => {
    return {
        country: selectedCountry.value || null,
    };
});

const filteredAuthor = computed(() => {
    return {
        author_id: selectedAuthor.value || null,
    };
});

async function handleScrolledToBottom(isVisible) {
    if (!isVisible) return;

    currentPage.value++;

    if (currentPage.value > lastPage.value) return;

    await pokerRoomStore.getRooms({
        page: currentPage.value,
        country: selectedCountry.value || null,
    });
    rooms.value.push(...pokerRoomStore.rooms.data);
    lastPage.value = pokerRoomStore.rooms.meta.last_page;
}

async function handleScrolledToBottomMedia(isVisible) {
    if (!isVisible) return;

    currentPage.value++;

    if (currentPage.value > lastPage.value) return;

    await mediaStore.getMedia({
        page: currentPage.value,
    });
    medias.value.push(...mediaStore.media.data);
    lastPage.value = mediaStore.media.meta.last_page;
}

function resetFilter() {
    selectedCountry.value = "";
    selectedAuthor.value = "";
}

async function submitMessage() {
    try {
        const { data } = await axios.post("api/contact", {
            name: name.value,
            email: email.value,
            subject: subject.value,
            message: message.value,
        });
        name.value = null;
        email.value = null;
        subject.value = null;
        message.value = null;
        createToast("Message has been sent.", {
            position: "top-center",
            hideProgressBar: true,
            type: "success",
            transition: "slide",
            timeout: 2000,
            showIcon: true,
            showCloseButton: true,
        });
    } catch (error) {
        console.error(error.response.data.message);
    }
}

onMounted(async () => {
    if (props.page.template === "rooms") {
        await pokerRoomStore.getRooms({
            page: 1,
        });
        rooms.value = pokerRoomStore.rooms.data;
        lastPage.value = pokerRoomStore.rooms.meta.last_page;
        await pokerRoomStore.getCountries();
        countries.value = pokerRoomStore.countries.data;
    }
    if (props.page.template === "videos") {
        await mediaStore.getMedia({
            page: 1,
        });
        medias.value = mediaStore.media.data;
        lastPage.value = mediaStore.media.meta.last_page;
        await mediaStore.getMediaAuthors();
        authors.value = mediaStore.authors.data;
    }
});

watch(
    () => filteredLocation.value,
    async function (value) {
        await pokerRoomStore.getRooms({
            page: 1,
            ...value,
        });
        currentPage.value = 1;
        rooms.value = pokerRoomStore.rooms.data;
        lastPage.value = pokerRoomStore.rooms.meta.last_page;
    }
);
watch(
    () => filteredAuthor.value,
    async function (value) {
        await mediaStore.getMedia({
            page: 1,
            ...value,
        });
        currentPage.value = 1;
        medias.value = mediaStore.media.data;
        lastPage.value = mediaStore.media.meta.last_page;
    }
);
</script>

<style scoped>
:deep(.post-content p) {
    padding: unset !important;
}

:deep(.post-content h2) {
    padding: 0;
}

:deep(.post-content ol li) {
    font-size: 16px;
    list-style: decimal;
}

:deep(.post-content ul li) {
    font-size: 16px;
    list-style: disc;
}

:deep(.post-content ol li a) {
    color: #f44336;
}

:deep(.post-content table) {
    width: 100%;
    margin-bottom: 10px;
    border: 1px solid #95a5a662;
}

:deep(.post-content table tr td) {
    padding: 5px 10px;
    font-family: Lato, sans-serif;
    font-size: 14px;
    background-color: #fbfbfb;
}

.contact-email,
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

.contact-form-box #contact-form input.contact-input--error {
    border-width: 2px;
    border-color: #f44336;
}

.filters {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 15px;
    margin-bottom: 40px;
    font-family: "Lato", sans-serif;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(25rem, 1fr));
    gap: 30px;
}
</style>
