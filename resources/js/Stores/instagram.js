import axios from "axios";
import { defineStore } from "pinia";

export const useIGStore = defineStore("instagram", {
    state: () => {
        return {
            igFeed: null,
        };
    },

    actions: {
        async getIGFeed() {
            try {
                const { data } = await axios.get("/api/instagram");
                this.igFeed = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
