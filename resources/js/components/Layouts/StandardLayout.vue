<template>
  <div class="w-screen h-screen overflow-hidden bg-gray-200">
    <div class="flex items-center justify-between w-full h-16 px-4 text-white bg-slate">
      <div>CrucialDev</div>
      <div>
        <div
          class="flex items-center justify-center w-10 h-10 text-white bg-gray-900 rounded-full"
        >{{ $page.user.initials || 'G'}}</div>
      </div>
    </div>
    <div class="flex content-body">
      <div class="w-24 h-full px-2 py-8 bg-gray-400 min-w-24">
        <a
          class="inline-block w-full px-2 pb-2 rounded hover:underline hover:bg-blue hover:text-white"
          href="/clients"
        >Clients</a>
        <a
          class="inline-block w-full p-2 rounded hover:underline hover:bg-blue hover:text-white"
          href="/projects"
        >Projects</a>
      </div>
      <div class="w-full h-full p-8">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    visitUrl(url) {
      this.$inertia.visit(url);
    }
  }
};
</script>