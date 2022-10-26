import axios from "axios";
import { defineStore } from "pinia";

export const useArticleCategoryStore = defineStore("articleCategory", {
    state: () => {
        return {
            articleCategoryLists: [],
            categortLists: [],
        };
    },

    actions: {
        async getArticleCategoryLists(slug, page) {
            try {
                if (slug == undefined) {
                    const { data } = await axios.get(
                        `/api/article?page=${page}`
                    );
                    this.articleCategoryLists = data;
                    return;
                }
                const { data } = await axios.get(
                    `/api/article/category/${slug}?page=${page}`
                );
                this.articleCategoryLists = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getCategoryLists() {
            try {
                const { data } = await axios.get("/api/category/article");
                this.categoryLists = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
