import axios from "axios";
import { defineStore } from "pinia";

export const useCategoryStore = defineStore("category", {
    state: () => {
        return {
            categoryLists: [],
        };
    },

    actions: {
        async getCategoryLists(slug, page) {
            try {
                const { data } = await axios.get(
                    `/api/article/category/${slug}?page=${page}`
                );
                this.categoryLists = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
