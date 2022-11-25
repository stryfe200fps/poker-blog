<template>
    <Head>
        <title>{{ page.title }}</title>
    </Head>
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
            <div v-if="isLoading">
                <LoadingBar />
            </div>
            <div v-else>
                <div class="grid" v-if="rooms?.length">
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
                <div v-else>
                    <h4>There are no poker rooms at the moment.</h4>
                </div>
            </div>
        </div>
        <div v-if="page.template === 'videos'">
            <div class="row" style="margin-bottom: 25px">
                <div class="col-md-6">
                    <div class="filters left-filters">
                        <button
                            type="button"
                            class="btn btn-default"
                            @click="getDateToday()"
                        >
                            Today
                        </button>
                        <div class="custom-date-picker">
                            <div
                                class="custom-date-picker__btn"
                                @click="openDatePicker"
                                @blur="isOpen = false"
                                tabindex="0"
                            >
                                <span>{{ datePlaceholder }}</span>
                                <i
                                    class="fas fa-angle-down custom-date-picker__icon"
                                    :class="{ up: isOpen }"
                                ></i>
                            </div>
                            <div>
                                <input
                                    type="date"
                                    v-model="selectedDate"
                                    class="custom-date-picker__input"
                                    id="custom-date"
                                    @change="changeDate"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filters right-filters">
                        <h5>Find By:</h5>
                        <div>
                            <select
                                class="form-control"
                                v-model="selectedCategory"
                            >
                                <option value="" selected disabled>
                                    Select Category
                                </option>
                                <option
                                    v-for="(category, index) in categories"
                                    :key="index"
                                    :value="category.slug"
                                >
                                    {{ category.title }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="isLoading">
                <LoadingBar />
            </div>
            <div v-else>
                <div class="grid" v-if="medias?.length">
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
                <div v-else>
                    <h4>
                        There are no
                        <span class="text-lowercase">{{ page.title }}</span>
                        at the moment.
                    </h4>
                </div>
            </div>
        </div>
        <div v-if="page.template === 'tours'">
            <div v-if="isLoading">
                <LoadingBar />
            </div>
            <div v-else>
                <div class="grid" v-if="tours?.length">
                    <PokerTours
                        v-for="(tour, index) in tours"
                        :key="index"
                        :tour="tour"
                    />
                </div>
                <div
                    v-if="tours?.length"
                    v-observe-visibility="handleScrolledToBottomTours"
                ></div>
                <div v-else>
                    <h4>There are no poker tours at the moment.</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { useRoomStore } from "@/Stores/pokerRoom.js";
import { useTourStore } from "@/Stores/pokerTour.js";
import { useMediaStore } from "@/Stores/mediaReports.js";
import { onMounted, ref, computed, watch } from "@vue/runtime-core";
import axios from "axios";
import { createToast } from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";
import moment from "moment";

import LoadingBar from "@/Components/LoadingBar.vue";
import PokerRooms from "@/Components/Frontend/PokerRooms.vue";
import PokerTours from "@/Components/Frontend/PokerTours.vue";
import MediaReporting from "@/Components/Frontend/MediaReporting.vue";

const name = ref(null);
const email = ref(null);
const subject = ref("");
const message = ref(null);
const countries = ref([]);
const selectedCountry = ref("");
const rooms = ref([]);
const tours = ref([]);
const medias = ref([]);
const categories = ref([]);
const selectedCategory = ref("");
const currentPage = ref(1);
const lastPage = ref(1);
const pokerRoomStore = useRoomStore();
const pokerTourStore = useTourStore();
const mediaStore = useMediaStore();
const selectedDate = ref(moment().format("YYYY-MM-DD"));
const isOpen = ref(false);
const isLoading = ref(true);

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

const filteredMedia = computed(() => {
    return {
        category: selectedCategory.value || null,
        date_start: selectedDate.value,
    };
});

const datePlaceholder = computed(() => {
    return selectedDate.value === moment().format("YYYY-MM-DD")
        ? "Upcoming"
        : `${moment(new Date(selectedDate.value)).format("MMMM D")} onwards`;
});

function getDateToday() {
    selectedDate.value = moment().format("YYYY-MM-DD");
    selectedCategory.value = "";
}

function openDatePicker() {
    document.getElementById("custom-date").showPicker();
    isOpen.value = !isOpen.value;
}

function changeDate() {
    isOpen.value = false;
}

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
        category: selectedCategory.value || null,
        date_start: selectedDate.value,
    });
    medias.value.push(...mediaStore.media.data);
    lastPage.value = mediaStore.media.meta.last_page;
}

async function handleScrolledToBottomTours(isVisible) {
    if (!isVisible) return;

    currentPage.value++;

    if (currentPage.value > lastPage.value) return;

    await pokerTourStore.getTours({
        page: currentPage.value,
    });
    tours.value.push(...pokerTourStore.tours.data);
    lastPage.value = pokerTourStore.tours.meta.last_page;
}

function resetFilter() {
    selectedCountry.value = "";
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
        isLoading.value = true;
        await pokerRoomStore.getRooms({
            page: 1,
        });
        rooms.value = pokerRoomStore.rooms.data;
        lastPage.value = pokerRoomStore.rooms.meta.last_page;
        await pokerRoomStore.getCountries();
        countries.value = pokerRoomStore.countries.data;

        if (rooms.value) isLoading.value = false;
    }
    if (props.page.template === "videos") {
        isLoading.value = true;
        await mediaStore.getMedia({
            page: 1,
            date_start: selectedDate.value,
        });
        medias.value = mediaStore.media.data;
        lastPage.value = mediaStore.media.meta.last_page;
        await mediaStore.getMediaCategories();
        categories.value = mediaStore.categories.data;

        if (medias.value) isLoading.value = false;
    }
    if (props.page.template === "tours") {
        isLoading.value = true;
        await pokerTourStore.getTours({
            page: 1,
        });
        tours.value = pokerTourStore.tours.data;
        lastPage.value = pokerTourStore.tours.meta.last_page;

        if (tours.value) isLoading.value = false;
    }
});

watch(
    () => filteredLocation.value,
    async function (value) {
        isLoading.value = true;
        await pokerRoomStore.getRooms({
            page: 1,
            ...value,
        });
        currentPage.value = 1;
        rooms.value = pokerRoomStore.rooms.data;
        lastPage.value = pokerRoomStore.rooms.meta.last_page;

        if (rooms.value) isLoading.value = false;
    }
);
watch(
    () => filteredMedia.value,
    async function (value) {
        isLoading.value = true;
        await mediaStore.getMedia({
            page: 1,
            ...value,
        });
        currentPage.value = 1;
        medias.value = mediaStore.media.data;
        lastPage.value = mediaStore.media.meta.last_page;

        if (medias.value) isLoading.value = false;
    }
);
</script>

<style scoped>
:deep(.post-content p) {
    padding: unset !important;
}
:deep(.post-content h1),
:deep(.post-content h2),
:deep(.post-content h3),
:deep(.post-content h4),
:deep(.post-content h5),
:deep(.post-content h6) {
    font-family: Lato, sans-serif;
    font-size: 16px;
    padding: 0;
}

:deep(.post-content ol li) {
    font-family: Lato, sans-serif;
    font-size: 16px;
    list-style: decimal;
}

:deep(.post-content ul li) {
    font-family: Lato, sans-serif;
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
    justify-content: flex-end;
    align-items: center;
    gap: 15px;
    margin-bottom: 40px;
    font-family: "Lato", sans-serif;
}

.left-filters {
    justify-content: flex-start;
    margin-bottom: 15px;
}

.right-filters {
    display: block;
}

.right-filters select:not(:last-child) {
    margin-bottom: 15px;
}

.custom-date-picker {
    position: relative;
}

.custom-date-picker__btn {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 10px;
    cursor: pointer;
}

.custom-date-picker__icon {
    transition: transform 0.5s ease;
}

.custom-date-picker__icon.up {
    transform: rotate(180deg);
}

.custom-date-picker__input {
    position: absolute;
    top: -15px;
    z-index: -1;
    pointer-events: none;
    opacity: 0;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(25rem, 1fr));
    gap: 30px;
}

@media (min-width: 992px) {
    .left-filters {
        margin-bottom: 0;
    }
}

@media (min-width: 768px) {
    .right-filters {
        display: flex;
    }

    .right-filters select:not(:last-child) {
        margin-bottom: 0;
    }
}
</style>
