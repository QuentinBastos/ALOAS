<!-- assets/components/home.vue -->
<template>
  <Header/>
  <div class="flex w-screen h-[91vh]">
    <Aside class="w-1/6 "/>
    <div class="w-5/6 flex flex-col items-center mt-8 text-xl font-medium">
      <h1 class="text-[#19864e] mb-4">Derniers Match</h1>
      <ul class="flex flex-col gap-4 w-full items-center overflow-y-scroll grid grid-cols-2 justify-center gap-8 px-12 pb-6">
        <li v-for="index in 10" :key="index" class="h-[12.5vh] ">
          <card-tournament />
        </li>
      </ul>
    </div>
  </div>
</template>
  
<script setup>

import Header from "../partial/header.vue";
import Aside from "../partial/aside.vue";
import CardTournament from "../tools/cardTournament.vue";

</script>

<style scoped>
.hello {
  color: blue;
}
</style>