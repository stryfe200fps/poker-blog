import axios from 'axios'
import { defineStore } from 'pinia'
// import { ref } from 'vue'

// You can name the return value of `defineStore()` anything you want, but it's best to use the name of the store and surround it with `use` and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useEventStore = defineStore('event', { 

  state: () => {
    return {
      eventData: [],
      liveReportList: [],
      mainEvents: []
    }
  },

  getters: {
     getLiveReportBySlug: (state) => {
      console.log(state.liveReportList)
      return (slug) => state.liveReportList.find((report) => report.slug === slug)
    },
  },

  actions: {  
  async getMainEvents() {
    await axios.get('/api/lof-event/')
      .then((res) => {
        this.mainEvents = res.data
      })
    },
   async getEventData(id) {
    await axios.get('/api/lof-event/'+ id)
      .then((res) => {
        this.eventData = res.data
      })
    },

    async getLiveReport(event, day ) {
      await axios.get(`/api/lof-live-report?event=${event}&filterDay=${day}`)
        .then((res) => {
          this.liveReportList = res.data
        })
      },
    // async getArticleBySlug(slug) {
    //   await axios.get('/api/article/'+ slug).then((res) => {
    //     this.singleArticle = res.data
    //   })
    // }
}

})

