<template>
  <div class="w-screen h-screen bg-gray-200 overflow-hidden">
    <div class="px-4 w-full h-16 bg-slate text-white flex items-center justify-between">
      <div>CrucialCRM</div>
      <div>
        <div
          class="h-10 w-10 rounded-full bg-gray-900 text-white flex items-center justify-center"
        >{{ $page.user.initials || 'G'}}</div>
      </div>
    </div>
    <div class="flex h-full">
      <div class="bg-gray-400 min-w-24 w-24 h-full px-2 py-8">
        <a
          class="inline-block px-2 pb-2 w-full rounded hover:underline hover:bg-blue hover:text-white"
          href="/clients"
        >Clients</a>
        <a
          class="inline-block p-2 w-full rounded hover:underline hover:bg-blue hover:text-white"
          href="/projects"
        >Projects</a>
      </div>
      <div class="p-8 w-full h-full">
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