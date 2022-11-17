<template>
  <div class="card">
  <div class="card-body row">

  </div>
</div>
</template>

<script setup>

import { ref, onMounted } from 'vue'
  import axios from 'axios'


  const result = ref([])

  const fetchMe = async () => {
    await axios.get('http://127.0.0.1:8000/api/article').then((d) => {
      result.value = d.data
    })
  }


  onMounted( async () => {
   await fetchMe();
  })



</script>
