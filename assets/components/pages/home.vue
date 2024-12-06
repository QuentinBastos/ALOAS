<!-- assets/components/home.vue -->
<template>
  <Header/>
  <div class="flex w-screen h-[91vh]">
    <Aside class="w-1/6"/>
    <div class="w-5/6 flex flex-col items-center mt-8 text-xl font-medium">
      <h1 class="text-[#19864e] mb-4">Liste des derniers Tournois</h1>
      <span class="border-t-2 border border-black w-1/6 mb-4"></span>
      <ul class="flex flex-col gap-4 w-full items-center">
        <li v-for="" class="w-3/4 h-[12.5vh]"><card-tournament /></li>
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