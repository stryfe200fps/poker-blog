<template>
    <div class="cookie row" :class="{ hide: getCookie || isSetCookie }">
        <div class="cookie__text col-sm-6 col-md-6">
            This website uses cookies to ensure you get the best experience on
            our website.
        </div>
        <div class="cookie__actions col-sm-6 col-md-6">
            <div>
                <div class="cookie__buttons">
                    <button
                        type="button"
                        class="btn btn-link btn-block"
                        @click="openPreference"
                    >
                        Manage Cookies
                    </button>
                    <button
                        type="button"
                        class="btn btn-danger btn-block"
                        @click="acceptAllCookies"
                    >
                        Accept All
                    </button>
                    <button
                        type="button"
                        class="btn btn-default btn-block save__btn"
                        :class="{ open: isOpen }"
                        @click="savePreferenceCookie"
                    >
                        Save Preference
                    </button>
                </div>
                <div class="cookie__preferences" :class="{ open: isOpen }">
                    <p>Manage Preference</p>
                    <div class="row" style="margin: 0 !important">
                        <div
                            class="cookie__preference col-xs-6 col-md-5"
                            v-for="(preference, index) in preferences"
                            :key="index"
                        >
                            <label class="switch">
                                <input
                                    type="checkbox"
                                    :value="preference"
                                    :checked="preference === 'Necessary'"
                                    :disabled="preference === 'Necessary'"
                                    v-model="selectedPreference"
                                />
                                <span class="slider"></span>
                            </label>
                            {{ preference }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "@vue/runtime-core";

const props = defineProps({
    isOpen: {
        type: Boolean,
    },
});

const isOpen = ref(false);
const isSetCookie = ref(false);
const preferences = ref([
    "Necessary",
    "Analytics",
    "Functionality",
    "Marketing",
]);
const selectedPreference = ref(["Necessary"]);

const getCookie = computed(() => {
    const cookieArr = document.cookie.split(";");

    for (let i = 0; i < cookieArr.length; i++) {
        const cookiePair = cookieArr[i].split("=");

        if (cookiePair[0].trim() === "lop") {
            return true;
        }
    }
    return false;
});

function openPreference() {
    isOpen.value = !isOpen.value;
}

function acceptAllCookies() {
    document.cookie = `lop=${preferences.value}; expires=Fri, 31 Dec 9999 23:59:59 GMT`;
    if (document.cookie) {
        isSetCookie.value = true;
    }
}

function savePreferenceCookie() {
    document.cookie = `lop=${selectedPreference.value}; expires=Fri, 31 Dec 9999 23:59:59 GMT`;
    if (document.cookie) {
        isSetCookie.value = true;
    }
}
</script>

<style scoped>
.cookie {
    position: fixed;
    left: 0;
    bottom: 0;
    margin: 0 !important;
    width: 100%;
    padding: 2rem 1rem;
    background-color: #c4c4c4;
}

.cookie.hide {
    display: none;
}

.cookie__text {
    margin-bottom: 1.5rem;
    font-family: "Lato", sans-serif;
    font-size: 15px;
    color: #2d3436;
}

.cookie__actions button:focus {
    outline: none !important;
    text-decoration: none !important;
}

.save__btn {
    display: none !important;
}

.save__btn.open {
    display: block !important;
}

.cookie__preferences {
    display: none;
    margin-top: 1.3rem;
}

.cookie__preferences.open {
    display: block;
}

.cookie__preference {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 1rem;
    padding-left: 0 !important;
    font-family: "Lato", sans-serif;
    font-size: 14px;
}

.switch {
    position: relative;
    display: inline-block;
    width: 3.5em;
    height: 2em;
    margin-bottom: 0 !important;
    font-size: 8px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    inset: 0;
    background-color: #2d3436;
    transition: 0.4s;
    border-radius: 30px;
    cursor: pointer;
}

.slider:before {
    content: "";
    position: absolute;
    left: 0.3em;
    bottom: 0.3em;
    height: 1.4em;
    width: 1.4em;
    background-color: white;
    border-radius: 20px;
    transition: 0.4s;
}

input:checked + .slider {
    background-color: rgb(0, 221, 80);
}

input:focus + .slider {
    box-shadow: 0 0 1px rgb(0, 221, 80);
}

input:checked + .slider:before {
    transform: translateX(1.5em);
}

@media (min-width: 768px) {
    .cookie {
        display: flex;
    }

    .cookie__text {
        display: flex;
        align-items: center;
        margin-bottom: 0;
    }

    .cookie__actions {
        display: flex;
        justify-content: flex-end;
    }

    .cookie__actions .cookie__buttons {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cookie__actions button {
        display: inline-block;
        width: auto;
        margin: 0 !important;
    }
}
</style>
