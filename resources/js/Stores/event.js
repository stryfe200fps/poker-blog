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
        };
    },

    getters: {
        getLiveReportBySlug: (state) => {
            return (slug) =>
                state.liveReportList.find((report) => report.slug === slug);
        },
    },

    actions: {
        async getMainEvents() {
            try {
                const { data } = await axios.get("/api/event/");

                this.mainEvents = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getEventData(id) {
            // if (this.eventData.length) return;
            const { data } = await axios.get("/api/event/" + id);
            this.eventData = data;
        },
        async getLiveReport(page, day) {
            try {
                let { data } = await axios.get(
                    // `/api/report?page=${page}&event=${event}&filterDay=${day}`
                    `/api/report?page=${page}&day=${day}`
                );
                this.liveReportList = data;
            } catch (error) {
                console.error(error);
            }
        },
        // async getChipCountsData(id) {
        //     const { data } = await axios.get(
        //         "/api/lof-event/" + id + "/chipcount"
        //     );
        //     this.chipCounts = data;
        // },
        async getChipCountsData(day) {
            try {
                // if (this.chipCounts.length) return;
                const { data } = await axios.get("/api/chip/day/" + day);
                this.chipCounts = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getWhatsappData(day) {
            try {
                // if (this.chipCounts.length) return;
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
                // if (this.galleryData.length) return;
                const { data } = await axios.get("/api/gallery/day/" + day);
                this.galleryData = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getPayoutsData(slug) {
            try {
                // if (this.payouts.length) return;
                const { data } = await axios.get("/api/payout/event/" + slug);
                this.payouts = data;
            } catch (error) {
                console.error(error);
            }
        },
        // async getArticleBySlug(slug) {
        //   await axios.get('/api/article/'+ slug).then((res) => {
        //     this.singleArticle = res.data
        //   })
        // }
    },
});
