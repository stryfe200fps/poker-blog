import axios from "axios";
import { defineStore } from "pinia";

export const useMediaStore = defineStore("media", {
    state: () => {
        return {
            media: [],
            authors: [],
        };
    },

    actions: {
        async getMediaAuthors() {
            try {
                let { data } = await axios.get(
                    `/api/media-reports/select/authors`
                );
                this.authors = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getMedia({ page, author_id = null }) {
            try {
                let { data } = await axios.get(`/api/media-reports`, {
                    params: { page, author_id },
                });
                this.media = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
