import axios from "axios";
import { defineStore } from "pinia";

export const useReportStore = defineStore("report", {
    state: () => {
        return {
            list: [],
        };
    },

    actions: {
        async getList() {
            try {
                const { data } = await axios.get("/api/tournaments/");
                this.list = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
