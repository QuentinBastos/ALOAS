<!-- assets/components/HelloWorld.vue -->
<template>
  <div class="hello">
    <h1>{{ message }}</h1>
  </div>
</template>

<script setup>

import {ref} from "vue";

const message = ref('Hello, Vue 3!')
</script>

<style scoped>
.hello {
  color: blue;
}
</style>