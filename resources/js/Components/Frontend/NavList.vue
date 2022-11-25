<template>
    <div class="nav-list-container" style="border: none">
        <div class="container">
            <div
                class="collapse navbar-collapse navbar-collapse--custom"
                :class="{ pull: toggleMenu }"
                id="bs-example-navbar-collapse-1"
            >
                <ul class="nav navbar-nav navbar-left navbar-nav--custom">
                    <li class="drop drop-img">
                        <Link href="/">
                            <img class="drop-logo" :src="logo" alt="Logo" />
                        </Link>
                    </li>
                    <NavLinks
                        v-for="menu in $page['props']['menu']"
                        :key="menu.id"
                        :menu="menu"
                        @closeMenu="closeMenu"
                    />
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

import NavLinks from "./NavLinks.vue";
import logo from "/public/lop_logo_white.svg";

const props = defineProps({
    toggleMenu: {
        type: Boolean,
    },
});

const emit = defineEmits(["closeMenu"]);

function closeMenu() {
    emit("closeMenu");
}
</script>

<style scoped>
.drop-logo {
    width: 80px;
}

.collapse {
    display: block;
}

.navbar-collapse--custom {
    scrollbar-width: none;
}

.navbar-collapse--custom::-webkit-scrollbar {
    display: none;
}

.navbar-nav .drop-img a {
    padding-left: 0 !important;
}

.drop-img {
    display: none;
}

.drop-img.scroll {
    display: block;
}

.drop-img a::after {
    opacity: 0;
}

.navbar-nav--custom > li > a:before {
    display: none;
}

@media screen and (max-width: 1199px) {
    .drop-img {
        padding-right: 15px;
    }

    .navbar-nav--custom > li > a {
        padding-inline-start: 20px;
    }
}

@media screen and (max-width: 767px) {
    .drop-img {
        display: none;
    }

    .navbar-nav--custom {
        margin-block: 0;
    }

    .navbar-collapse--custom {
        display: none;
        position: fixed;
        width: 100%;
        min-height: 100vh;
        background-color: #2a2828;
    }

    .navbar-collapse--custom.pull {
        display: block;
        animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
}

@media screen and (min-width: 769px) {
    .navbar-nav--custom {
        display: flex;
        align-items: center;
    }

    .navbar-nav--custom > li > a {
        padding-block: 15px;
    }
}
</style>
