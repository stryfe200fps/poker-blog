import axios from "axios";
import { defineStore } from "pinia";

export const useTourStore = defineStore("tours", {
    state: () => {
        return {
            tours: [],
            singleTour: [],
            years: [],
            seriesList: [],
        };
    },

    actions: {
        async getYears(slug) {
            try {
                let { data } = await axios.get(
                    `/api/tours/${slug}/select/years`
                );
                this.years = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getTours({ page }) {
            try {
                let { data } = await axios.get(`/api/tours`, {
                    params: { page },
                });
                this.tours = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getSingleTour(slug) {
            try {
                let { data } = await axios.get(`/api/tours/${slug}`);
                this.singleTour = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getSeriesList({ slug, year = null }) {
            try {
                let { data } = await axios.get(`/api/tours/${slug}`, {
                    params: { year },
                });
                this.seriesList = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
