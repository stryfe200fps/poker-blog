<template>
    <div
        class="toast"
        :class="{ active: isActive }"
        @click="emit('scrollToTop')"
    >
        <div class="toast-content">
            <i class="fas fa-info-circle info"></i>

            <div class="message">
                <span class="text text-1">New post - click here</span>
            </div>
        </div>
        <div class="progress" :class="{ active: isActive }"></div>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    isActive: {
        type: Boolean,
    },
});

const emit = defineEmits(["scrollToTop"]);
</script>

<style scoped>
.toast {
    position: fixed;
    top: 25px;
    right: 30px;
    z-index: 1000;
    overflow: hidden;
    padding: 20px 35px 20px 25px;
    background-color: #fff;
    border-radius: 12px;
    cursor: pointer;
    box-shadow: 0 6px 20px -5px rgba(0, 0, 0, 0.5);
    transform: translateX(calc(100% + 30px));
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
}

.toast.active {
    transform: translateX(0%);
}

.toast .toast-content {
    display: flex;
    align-items: center;
}

.toast-content .info {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
}

.toast-content .message {
    display: flex;
    flex-direction: column;
    margin: 0 20px;
}

.message .text {
    font-size: 16px;
    font-weight: 400;
    color: #666666;
}

.message .text.text-1 {
    font-weight: 600;
    color: #333;
}

.toast .progress {
    position: absolute;
    bottom: -20px;
    left: 0;
    width: 100%;
    height: 3px;
}

.toast .progress:before {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background-color: #f44336;
}

.progress.active:before {
    animation: progress 5s linear forwards;
}

@keyframes progress {
    100% {
        right: 100%;
    }
}
</style>
