import axios from "axios";
import { defineStore } from "pinia";

export const useTagStore = defineStore("tag", {
    state: () => {
        return {
            tagLists: [],
        };
    },

    actions: {
        async getTagLists(slug) {
            try {
                const { data } = await axios.get(`/api/tag/articles/${slug}`);
                this.tagLists = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
