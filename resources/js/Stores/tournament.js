import axios from "axios";
import { defineStore } from "pinia";
<<<<<<< HEAD

=======
// import { ref } from 'vue'

// You can name the return value of `defineStore()` anything you want, but it's best to use the name of the store and surround it with `use` and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
export const useTournamentStore = defineStore("tournament", {
    state: () => {
        return {
            list: [],
            upcoming: [],
<<<<<<< HEAD
        };
    },
=======

            //   slugs: []
        };
    },

    getters: {
        //  getTournamentById: (state) => {
        //   return (slug) => state.list.data.find((article) => article.slug === slug)
        // },
    },
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32

    actions: {
        async getList(page, status) {
            try {
                if (status === "upcoming") {
                    const { data } = await axios.get(
                        `/api/tournaments?page=${page}&status=${status}`
                    );
                    this.upcoming = data;
<<<<<<< HEAD
                    return;
=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
                }
                const { data } = await axios.get(
                    `/api/tournaments?page=${page}&status=${status}`
                );
                this.list = data;
            } catch (error) {
                console.error(error);
            }
        },
<<<<<<< HEAD
=======
        // async getArticleBySlug(slug) {
        //   await axios.get('/api/article/'+ slug).then((res) => {
        //     this.singleArticle = res.data
        //   })
        // }
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    },
});
