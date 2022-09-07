<template>
  <div> 
  <router-link  class="link" to="/about">About </router-link> <br>
  <router-link  class="link" to="/article">Article</router-link> <br>
  <router-link  class="link" to="/poker">Live Reporting</router-link> <br>
  <br> 
    {{ peoples ?? '' }}
  <router-view /> 
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
const peoples = ref(null);

onMounted(async () => {
  const response = await fetch('https://jsonplaceholder.typicode.com/todos/1')
   peoples.value =  await response.json()
})

</script>