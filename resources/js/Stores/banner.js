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
        getHomeSemiFullBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) => banner.location === "home-background-full-1600"
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
        getReportingSemiFullBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) =>
                        banner.location === "reporting-background-full-1600"
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
                    (banner) =>
                        banner.location === "live reporting-top-landscape"
                );
        },
        getLiveReportingFullBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) =>
                        banner.location === "live reporting-background-full"
                );
        },
        getLiveReportingSemiFullBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) =>
                        banner.location ===
                        "live reporting-background-full-1600"
                );
        },
        getLiveReportingSideBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) =>
                        banner.location === "live reporting-column-square"
                );
        },
        getLiveReportingBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) => banner.location === "reporting-top-landscape"
                );
        },
        getEventCalendarFullBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) =>
                        banner.location === "event calendar-background-full"
                );
        },
        getEventCalendarSemiFullBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) =>
                        banner.location ===
                        "event calendar-background-full-1600"
                );
        },
        getEventCalendarSideBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) =>
                        banner.location === "event calendar-column-square"
                );
        },
        getEventCalendarBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) =>
                        banner.location === "event calendar-top-landscape"
                );
        },
        getPokerRoomFullBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) =>
                        banner.location === "poker rooms-background-full"
                );
        },
        getPokerRoomSemiFullBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) =>
                        banner.location === "poker rooms-background-full-1600"
                );
        },
        getPokerRoomSideBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) => banner.location === "poker rooms-column-square"
                );
        },
        getPokerRoomBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) => banner.location === "poker rooms-top-landscape"
                );
        },
        getPokerTourFullBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) =>
                        banner.location === "poker tours-background-full"
                );
        },
        getPokerTourSemiFullBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) =>
                        banner.location === "poker tours-background-full-1600"
                );
        },
        getPokerTourSideBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) => banner.location === "poker tours-column-square"
                );
        },
        getPokerTourBanner: (state) => {
            return (slug) =>
                state.banners.data?.find(
                    (banner) => banner.location === "poker tours-top-landscape"
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
