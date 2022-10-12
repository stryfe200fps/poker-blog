import axios from "axios";
import { defineStore } from "pinia";

export const useEventStore = defineStore("event", {
    state: () => {
        return {
            eventData: [],
            liveReportList: [],
            mainEvents: [],
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
            const { data } = await axios.get("/api/lof-event/");

            this.mainEvents = data;
        },
        async getEventData(id) {
            const { data } = await axios.get("/api/lof-event/" + id);
            this.eventData = data;
        },

        async getLiveReport(page, event, day) {
            try {
                let { data } = await axios.get(
                    `/api/lof-live-report?page=${page}&event=${event}&filterDay=${day}`
                );
                this.liveReportList = data;
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
