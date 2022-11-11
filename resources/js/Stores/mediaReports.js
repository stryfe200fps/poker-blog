import axios from "axios";
import { defineStore } from "pinia";

export const useMediaStore = defineStore("media", {
    state: () => {
        return {
            media: [],
            categories: [],
        };
    },

    actions: {
        async getMediaCategories() {
            try {
                let { data } = await axios.get(
                    `/api/media-reports/select/categories`
                );
                this.categories = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getMedia({ page, category = null, date_start }) {
            try {
                let { data } = await axios.get(`/api/media-reports`, {
                    params: { page, category, date_start },
                });
                this.media = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
