import axios from "axios";
import { defineStore } from "pinia";

export const useEventCalendarStore = defineStore("eventCalendar", {
    state: () => {
        return {
            tours: [],
            countries: [],
            games: [],
            series: [],
            filter: [],
        };
    },

    actions: {
        async getTours() {
            try {
                const { data } = await axios.get("/api/select/tours/");
                this.tours = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getCountries() {
            try {
                const { data } = await axios.get("/api/select/countries");
                this.countries = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getGames() {
            try {
                let { data } = await axios.get("/api/select/games");
                this.games = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getSeries({
            page,
            country = null,
            tour = null,
            game = null,
            date_start,
        }) {
            try {
                let { data } = await axios.get(`/api/lof-event-index`, {
                    params: { page, country, tour, game, date_start },
                });
                this.series = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
