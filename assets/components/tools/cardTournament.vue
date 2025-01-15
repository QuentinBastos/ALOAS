<template>
  <div class="h-full w-auto flex flex-col border-2 rounded shadow py-2">
    <div class=" h-[5%] w-full flex items-center justify-center">
      <p class="font-base text-sm">Pétanque</p>
    </div>
    <div class="flex items-center justify-around h-[95%]">
      <img :src="require('@img/team/bird.svg')" alt="bird" class="h-full" />
      <p>3</p>
      <p>VS</p>
      <p>0</p>
      <img :src="require('@img/team/bird.svg')" alt="bird" class="h-full" />
    </div>
  </div>
</template>

<script setup lang="ts">

</script>

<style scoped>

</style>