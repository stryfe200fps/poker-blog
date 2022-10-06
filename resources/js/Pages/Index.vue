<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Header from '../Components/Frontend/Header.vue';
import Footer from '../Components/Frontend/Footer.vue';
import FrontLayout from '../Layouts/FrontLayout.vue';
import SideBar from '../Components/Frontend/MainContent/SideBar.vue';
import MainBar from '../Components/Frontend/MainContent/MainBar.vue';
import { useArticleStore } from '../stores/article.js'
import { onMounted } from '@vue/runtime-core';

const articleStore = useArticleStore()

onMounted(async () => {
    articleStore.getList()
})

</script>

<template>
    <FrontLayout >
        <MainBar :article-list="articleStore.list" />
    </FrontLayout>
</template>
