import axios from "axios";
import { defineStore } from "pinia";

export const useBannerStore = defineStore("banner", {
    state: () => {
        return {
            banners: [],
        };
    },

    getters: {
        getSingleBanner: (state) => {
            return (slug) =>
                state.banners.data.find(
                    (banner) => banner.location === "home-background-full"
                );
        },
        getMainBanner: (state) => {
            return (slug) =>
                state.banners.data.find(
                    (banner) => banner.location === "home-top-landscape"
                );
        },
        getSideBanner: (state) => {
            return (slug) =>
                state.banners.data.find(
                    (banner) => banner.location === "home-column-square"
                );
        },
    },

    actions: {
        async getBanners() {
            try {
                const { data } = await axios.get("/api/banners");
                this.banners = data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
