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
            try {
                const { data } = await axios.get("/api/event/" + id);
                this.eventData = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getLiveReport(page, day) {
            try {
                let { data } = await axios.get(
                    `/api/report?page=${page}&day=${day}`
                );
                this.liveReportList = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getChipCountsData(day) {
            try {
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
                const { data } = await axios.get("/api/gallery/day/" + day);
                this.galleryData = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getPayoutsData(slug) {
            try {
                const { data } = await axios.get("/api/payout/event/" + slug);
                this.payouts = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
