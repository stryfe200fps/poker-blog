import axios from "axios";
import { defineStore } from "pinia";

export const useEventStore = defineStore("event", {
    state: () => {
        return {
            eventData: [],
            liveReportList: [],
            mainEvents: [],
            galleryData: [],
            payouts: [],
            chipCounts: [],
            whatsapp: [],
            whatsappContent: [],
        };
    },
<<<<<<< HEAD
=======

    getters: {
        getLiveReportBySlug: (state) => {
            return (slug) =>
                state.liveReportList.find((report) => report.slug === slug);
        },
    },

>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    actions: {
        async getMainEvents() {
            try {
                const { data } = await axios.get("/api/event/");
<<<<<<< HEAD
=======

>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
                this.mainEvents = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getEventData(id) {
<<<<<<< HEAD
            try {
                const { data } = await axios.get("/api/event/" + id);
                this.eventData = data;
            } catch (error) {
                console.error(error);
            }
=======
            // if (this.eventData.length) return;
            const { data } = await axios.get("/api/event/" + id);
            this.eventData = data;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        },
        async getLiveReport(page, day) {
            try {
                let { data } = await axios.get(
<<<<<<< HEAD
=======
                    // `/api/report?page=${page}&event=${event}&filterDay=${day}`
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
                    `/api/report?page=${page}&day=${day}`
                );
                this.liveReportList = data;
            } catch (error) {
                console.error(error);
            }
        },
<<<<<<< HEAD
        async getChipCountsData(day) {
            try {
=======
        // async getChipCountsData(id) {
        //     const { data } = await axios.get(
        //         "/api/lof-event/" + id + "/chipcount"
        //     );
        //     this.chipCounts = data;
        // },
        async getChipCountsData(day) {
            try {
                // if (this.chipCounts.length) return;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
                const { data } = await axios.get("/api/chip/day/" + day);
                this.chipCounts = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getWhatsappContent() {
            try {
                const { data } = await axios.get("/api/content/whatsapp");
                this.whatsappContent = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getWhatsappData(day) {
            try {
<<<<<<< HEAD
=======
                // if (this.chipCounts.length) return;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
                const { data } = await axios.get(
                    "/api/chip/day/" + day + "/whatsapp"
                );
                this.whatsapp = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getGalleryData(day) {
            try {
<<<<<<< HEAD
=======
                // if (this.galleryData.length) return;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
                const { data } = await axios.get("/api/gallery/day/" + day);
                this.galleryData = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getPayoutsData(slug) {
            try {
<<<<<<< HEAD
=======
                // if (this.payouts.length) return;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
                const { data } = await axios.get("/api/payout/event/" + slug);
                this.payouts = data;
            } catch (error) {
                console.error(error);
            }
        },
<<<<<<< HEAD
=======
        // async getArticleBySlug(slug) {
        //   await axios.get('/api/article/'+ slug).then((res) => {
        //     this.singleArticle = res.data
        //   })
        // }
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    },
});
