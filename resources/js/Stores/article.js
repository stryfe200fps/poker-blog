import axios from 'axios'
import { defineStore } from 'pinia'
// import { ref } from 'vue'

// You can name the return value of `defineStore()` anything you want, but it's best to use the name of the store and surround it with `use` and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useArticleStore = defineStore('article', { 

  state: () => {
    return {
      list: [],
      singleArticle: {},
      slugs: []
    }
  },

  getters: {
     getArticleBySlug: (state) => {
      return (slug) => state.list.data.find((article) => article.slug === slug)

    },
  },

  actions: {  
   async getList() {
    await axios.get('/api/article')
      .then((res) => {
        this.list = res.data
      })
    },
    // async getArticleBySlug(slug) {
    //   await axios.get('/api/article/'+ slug).then((res) => {
    //     this.singleArticle = res.data
    //   })
    // }
}

})

