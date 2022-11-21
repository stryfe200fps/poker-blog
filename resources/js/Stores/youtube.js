import axios from "axios";
import { defineStore } from "pinia";

export const useYoutubeStore = defineStore("youtube", {
    state: () => {
        return {
            youtubeLinks: [],
        };
    },

    actions: {
        async getYoutubeLinks() {
            try {
                const { data } = await axios.get("/api/settings");
                this.youtubeLinks = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
