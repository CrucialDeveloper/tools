<template>
  <div class="w-screen h-screen bg-gray-200 overflow-hidden">
    <div class="px-4 w-full h-16 bg-slate text-white flex items-center justify-between">
      <div>CrucialCRM</div>
      <div>
        <div
          class="h-10 w-10 rounded-full bg-gray-900 text-white flex items-center justify-center"
        >JL</div>
      </div>
    </div>
    <div class="flex h-full">
      <div class="bg-gray-500 w-24 h-full px-2 py-8 text-center">Clients</div>
      <div class="p-8 w-full">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>