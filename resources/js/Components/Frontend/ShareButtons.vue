<template>
    <div
        class="btn-group-vertical social-links-group"
        :class="{ show: isOpen }"
    >
        <li
            class="btn custom-btn"
            style="margin-right: 0; background-color: #1854dd"
        >
            <a
                target="_blank"
                :href="`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
                    url
                )}&amp;src=sdkpreparse`"
                ><i
                    class="fa-brands fa-facebook-f"
                    style="margin-right: 0; color: #fff"
                ></i>
            </a>
        </li>
        <li
            class="btn custom-btn"
            style="margin-right: 0; background-color: #18a3dd"
        >
            <a
                target="_blank"
                :href="`https://twitter.com/intent/tweet?text=${encodeURIComponent(
                    url
                )}`"
                ><i
                    class="fa fa-twitter"
                    style="margin-right: 0; color: #fff"
                ></i
            ></a>
        </li>
        <li class="btn custom-btn" style="background-color: #25d366">
            <a
                target="_blank"
                :href="`https://api.whatsapp.com/send?text=%0a${url}`"
                ><i
                    class="fa fa-whatsapp"
                    style="margin-right: 0; color: #fff"
                ></i
            ></a>
        </li>
    </div>
</template>

<script setup>
const props = defineProps({
    isOpen: {
        type: Boolean,
    },
    url: {
        type: String,
    },
});
</script>

<style scoped>
.share-btn-mobile {
    margin: 0;
}

.share-btn-mobile:focus {
    outline: none;
}

.social-links-group {
    position: absolute;
    top: 0;
    left: 25%;
    display: none;
    transform: translateY(-100px);
    transition: all 0.5s ease-in-out;
}

.social-links-group.show {
    display: block;
}

.social-links-group::before {
    content: "";
    position: absolute;
    bottom: -3px;
    left: 50%;
    height: 8px;
    width: 8px;
    background-color: #25d366;
    transform: translate(-50%) rotate(45deg);
}

.custom-btn {
    padding: 0;
}

.custom-btn a {
    padding: 6px 12px;
}
</style>
