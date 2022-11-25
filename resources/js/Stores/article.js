import axios from "axios";
import { defineStore } from "pinia";
// import { ref } from 'vue'

// You can name the return value of `defineStore()` anything you want, but it's best to use the name of the store and surround it with `use` and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useArticleStore = defineStore("article", {
    state: () => {
        return {
            list: [],
            related: [],
            singleArticle: [],
            slugs: [],
        };
    },

    // getters: {
    //     getArticleBySlug: (state) => {
    //         return (slug) =>
    //             state.list.data.find((article) => article.slug === slug);
    //     },
    // },

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
        // async getArticleBySlug(slug) {
        //   await axios.get('/api/article/'+ slug).then((res) => {
        //     this.singleArticle = res.data
        //   })
        // }
    },
});
