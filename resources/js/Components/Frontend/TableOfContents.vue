<template>
    <label
        id="table-of-contents"
        class="table-contents"
        v-if="article.content?.length > 1"
    >
        <div @click="isPull = !isPull" class="table-header">
            Table of Contents
        </div>
        <ul class="table-menu" :class="{ pull: isPull }">
            <li v-for="(content, index) in article.content" :key="index">
                <a
                    :href="'#content' + index"
                    v-html="content.title"
                    @click="isPull = false"
                ></a>
            </li>
        </ul>
    </label>
</template>

<script setup>
const props = defineProps({
    article: {
        type: Object,
    },
    isPull: {
        type: Boolean,
    },
});
</script>

<style scoped>
.table-contents {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    left: 0;
    z-index: 1;
    display: none;
    width: 100%;
    margin-bottom: 0;
    font-family: "Lato", sans-serif;
    font-size: 18px;
    font-weight: 400;
    background-color: #2d3436;
    border-bottom: 1px solid #222;
    color: #fff;
    user-select: none;
    box-shadow: 0px 8px 40px rgba(0, 0, 0, 0.2);
}

.table-contents.active {
    display: inline-block;
}

.table-header {
    display: inline-block;
    width: 100%;
    padding: 15px 30px 15px 20px;
    white-space: nowrap;
    cursor: pointer;
}

.table-header:after {
    content: "";
    position: absolute;
    top: 50%;
    right: 10px;
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid #fff;
    transform: translateY(-50%);
}

.table-menu {
    position: absolute;
    top: 100%;
    z-index: 1;
    right: 0;
    display: none;
    width: 100%;
    margin: 2px 0 0 0;
    padding: 0;
    font-family: "Lato", sans-serif;
    text-align: start;
    list-style-type: none;
    background-color: #2d3436;
    color: #fff;
    box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.1);
}

.table-menu.pull {
    display: block;
}

.table-menu li {
    border-bottom: 1px solid #fff;
    cursor: pointer;
}

.table-menu li:hover {
    background-color: #ccc;
}

.table-menu li a {
    display: block;
    width: 100%;
    padding: 10px 20px;
    text-decoration: none;
    color: #fff;
}
</style>
