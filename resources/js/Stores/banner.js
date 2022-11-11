import axios from "axios";
import { defineStore } from "pinia";

export const useBannerStore = defineStore("banner", {
    state: () => {
        return {
            banners: [],
        };
    },

    getters: {
        getHomeFullBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) => banner.location === "home-background-full"
                );
        },
        getMainBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) => banner.location === "home-top-landscape"
                );
        },
        getHomeSideBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) => banner.location === "home-column-square"
                );
        },
        getReportingFullBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) => banner.location === "reporting-background-full"
                );
        },
        getReportingSideBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) => banner.location === "reporting-column-square"
                );
        },
        getReportingBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) => banner.location === "reporting-top-landscape"
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
