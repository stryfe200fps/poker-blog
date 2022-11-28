import axios from "axios";
import { defineStore } from "pinia";

export const useArticleStore = defineStore("article", {
    state: () => {
        return {
            list: [],
            related: [],
            singleArticle: [],
            slugs: [],
        };
    },

    actions: {
        async getList() {
            try {
                const { data } = await axios.get("/api/article");
                this.list = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getSingleArticle(slug) {
            try {
                const { data } = await axios.get(`/api/article/${slug}`);
                this.singleArticle = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getRelatedNews(slug) {
            try {
                const { data } = await axios.get(
                    `/api/article/${slug}/related`
                );
                this.related = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
