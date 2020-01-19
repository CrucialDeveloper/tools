<template>
  <div class="h-screen">
    <div class="flex items-center justify-between w-full h-16 px-4 text-white bg-slate">
      <div>CrucialDev</div>
      <div>
        <div
          class="flex items-center justify-center w-10 h-10 text-white bg-gray-900 rounded-full"
        >{{ $page.user.initials || 'G'}}</div>
      </div>
    </div>
    <div class="flex content-body">
      <div class="w-24 px-2 py-8 bg-gray-400 min-w-24">
        <a
          class="inline-block w-full p-2 rounded hover:underline hover:bg-blue hover:text-white"
          href="/clients"
        >Clients</a>
        <a
          class="inline-block w-full p-2 rounded hover:underline hover:bg-blue hover:text-white"
          href="/projects"
        >Projects</a>
      </div>
      <div class="flex-grow-0 w-full pt-8 pb-4 pl-8 pr-4">
        <div class="h-full min-h-full pb-4 pr-4 overflow-hidden">
          <slot></slot>
        </div>
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