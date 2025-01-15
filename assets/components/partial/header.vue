<template>
  <nav class="shadow h-[9vh] flex items-center">
    <div class="container mx-auto flex justify-between items-center">
      <div class="flex items-center justify-center gap-2">
        <img :src="require('@img/aloas-logo.png')" alt="Logo" class="h-[6vh]">
        <h1 class="text-[#19864e] text-2xl font-bold">ALOAS</h1>
      </div>
      <div>
        <div class="flex ">
          <div class="flex items-center justify-center py-1 px-2 gap-2">
            <img :src="require('@img/icons/login.svg')" alt="account" width="16">
            <p class=" text-md font-medium text-[#19864e]">Assistance</p>
          </div>
          <div class="flex items-center justify-center py-1 px-2 gap-2">
            <img :src="require('@img/icons/login.svg')" alt="account" width="16">
            <p class=" text-md font-medium text-[#19864e]">Se connecter</p>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>

import { ref } from "vue";

</script>

<style scoped>
.hello {
  color: blue;
}
</style>