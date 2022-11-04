import axios from "axios";
import { defineStore } from "pinia";

export const useRoomStore = defineStore("rooms", {
    state: () => {
        return {
            rooms: [],
            singleRoom: [],
            countries: [],
        };
    },

    actions: {
        async getCountries() {
            try {
                const { data } = await axios.get("/api/select/countries");
                this.countries = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getRooms({ page, country = null }) {
            try {
                let { data } = await axios.get(`/api/rooms`, {
                    params: { page, country },
                });
                this.rooms = data;
            } catch (error) {
                console.error(error);
            }
        },
        async getSingleRoom(slug) {
            try {
                let { data } = await axios.get(`/api/rooms/${slug}`);
                this.singleRoom = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
