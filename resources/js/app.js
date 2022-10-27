import "./bootstrap";
import "../css/app.css";
import "vue3-country-flag-icon/dist/CountryFlag.css";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { ObserveVisibility } from "vue-observe-visibility";
import { createPinia } from "pinia";
import vueClickOutsideElement from "vue-click-outside-element";
const pinia = createPinia();

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText ||
    "LifeOfPoker";

createInertiaApp({
    title: (title) => `${title} | ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(pinia)
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .directive("observe-visibility", {
                beforeMount: (el, binding, vnode) => {
                    vnode.context = binding.instance;
                    ObserveVisibility.bind(el, binding, vnode);
                },
                update: ObserveVisibility.update,
                unmounted: ObserveVisibility.unbind,
            })
            .use(vueClickOutsideElement)
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });
