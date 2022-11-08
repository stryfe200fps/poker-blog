<template>
    <li class="drop" @click="toggleDropdown">
        <a
            class="home home--custom"
            :class="{
                child: menu.children.length,
                'router-link-active': pathname == menu.link,
            }"
            :href="menu.type === 'external_link' ? menu.link : '/' + menu.link"
            :target="menu.type === 'external_link' ? '_blank' : '_self'"
            v-if="!menu.children.length"
            >{{ menu.name }}</a
        >
        <a
            class="home home--custom"
            :class="{
                child: menu.children.length,
            }"
            href="#"
            v-else
        >
            {{ menu.name }}
        </a>
        <span
            class="dropdown-arrow"
            :class="{ show: toggleSubMenu }"
            v-if="menu.children.length"
            ><i class="fas fa-chevron-down"></i
        ></span>
        <ul
            class="dropdown"
            :class="{ show: toggleSubMenu }"
            v-if="menu.children.length"
        >
            <li v-for="children in menu.children" :key="children.id">
                <Link
                    v-if="
                        menu.link !== children.link &&
                        children.type === 'internal_link'
                    "
                    :href="'/' + menu.link + '/' + children.link"
                    style="background: rgb(239, 239, 239)"
                    >{{ children.name }}</Link
                >
                <Link
                    v-else-if="
                        menu.link !== children.link &&
                        children.type === 'page_link'
                    "
                    :href="'/' + children.page_slug"
                    style="background: rgb(239, 239, 239)"
                    >{{ children.name }}</Link
                >
                <a
                    v-else-if="
                        menu.link !== children.link &&
                        children.type === 'external_link'
                    "
                    :href="children.link"
                    style="background: rgb(239, 239, 239)"
                    target="_blank"
                    rel="noopener noreferrer"
                    >{{ children.name }}</a
                >
                <Link
                    v-else
                    :href="'/' + children.link"
                    style="background: rgb(239, 239, 239)"
                    >{{ children.name }}</Link
                >
            </li>
        </ul>
    </li>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    menu: Object,
});

const toggleSubMenu = ref(false);
const pathname = ref(window.location.pathname.split("/")[1]);

function toggleDropdown() {
    toggleSubMenu.value = !toggleSubMenu.value;
}
</script>

<style scoped>
.navbar-nav--custom > li > a {
    color: #fff !important;
}

.navbar-nav--custom > li > a:before {
    display: none;
}

.navbar-nav > li:nth-child(2) > a {
    padding-left: 0 !important;
}

.home--custom {
    padding-right: 20px !important;
}

.home--custom.child {
    padding-right: 30px !important;
}

.home--custom::after {
    top: 15px;
    opacity: 0;
}

.home--custom.child::after {
    opacity: 1;
}

.navbar-nav > li > a:not(.router-link-active):hover,
.navbar-nav > li > a:not(.router-link-active):hover::after {
    color: #f44336 !important;
}

.router-link-active,
.router-link-exact-active {
    background-color: #f44336 !important;
    color: white;
}

.dropdown-arrow {
    display: none !important;
}

@media screen and (max-width: 1199px) {
    .navbar-nav--custom > li > a {
        padding-inline-start: 20px;
    }
}

@media screen and (max-width: 767px) {
    .navbar-nav > li > a.home {
        display: inline-block;
        padding-inline: 0;
        padding-block: 15px;
    }

    .navbar-nav > li {
        border-bottom: 1px solid #5c5555;
    }

    .router-link-active,
    .router-link-exact-active {
        background-color: transparent !important;
    }

    .navbar-nav li.drop ul.dropdown {
        overflow: hidden;
        max-height: 0;
        transition: max-height 1s ease;
    }

    .navbar-nav li.drop ul.dropdown.show {
        max-height: 300px;
    }

    .navbar-nav li.drop ul.dropdown li:last-child {
        margin-bottom: 20px;
    }

    .navbar-nav li.drop ul.dropdown li a {
        display: inline-block;
        color: #f6f6f6;
    }

    .navbar-nav--custom > li {
        padding-left: 15px;
    }

    .dropdown-arrow {
        position: absolute;
        top: 13px;
        right: 30px;
        display: inline-block !important;
        transition: transform 0.5s ease;
    }

    .dropdown-arrow i {
        font-size: 12px;
        color: #fff;
    }

    .dropdown-arrow.show {
        transform: rotate(180deg);
    }
}

@media screen and (min-width: 769px) {
    .navbar-nav--custom > li > a {
        padding-block: 15px;
    }
}
</style>
