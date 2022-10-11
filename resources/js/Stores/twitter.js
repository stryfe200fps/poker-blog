import axios from "axios";
import { defineStore } from "pinia";

export const useTwitterStore = defineStore("twitter", {
    state: () => {
        return {
            tweetIDs: [],
        };
    },

    actions: {
        async getTweetID() {
            try {
                const { data } = await axios.get("/api/twitter");
                this.tweetIDs = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
