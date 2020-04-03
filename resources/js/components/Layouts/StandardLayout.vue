<template>
  <div class="h-screen">
    <div
      class="flex items-center justify-between w-full h-16 px-4 text-white bg-slate"
    >
      <div>CrucialDev</div>
      <div class="relative w-48">
        <button
          class="flex items-center justify-center w-10 h-10 ml-auto text-white bg-gray-900 rounded-full"
          @click="userMenuOpen = !userMenuOpen"
        >
          {{ $page.user.initials || "G" }}
        </button>
        <div
          class="absolute w-full p-4 mt-2 text-gray-800 bg-white rounded h-46"
          v-show="userMenuOpen"
        >
          <button class="underline" @click="logout">Logout</button>
        </div>
      </div>
    </div>
    <div class="flex content-body">
      <div class="w-24 px-2 py-8 text-white bg-slate min-w-24">
        <a
          class="inline-block w-full p-2 rounded hover:underline hover:bg-blue hover:text-white"
          href="/clients"
          >Clients</a
        >
        <a
          class="inline-block w-full p-2 rounded hover:underline hover:bg-blue hover:text-white"
          href="/projects"
          >Projects</a
        >
      </div>
      <div class="flex-grow-0 w-full">
        <div class="h-full min-h-full p-4 overflow-hidden">
          <slot></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      userMenuOpen: false
    };
  },
  methods: {
    visitUrl(url) {
      this.$inertia.visit(url);
    },
    logout() {
      this.$inertia.post("/logout");
    }
  }
};
</script>