import axios from "axios";
import { defineStore } from "pinia";

export const useTournamentStore = defineStore("tournament", {
    state: () => {
        return {
            list: [],
            upcoming: [],
        };
    },

    actions: {
        async getList(page, status) {
            try {
                if (status === "upcoming") {
                    const { data } = await axios.get(
                        `/api/tournaments?page=${page}&status=${status}`
                    );
                    this.upcoming = data;
                    return;
                }
                const { data } = await axios.get(
                    `/api/tournaments?page=${page}&status=${status}`
                );
                this.list = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
