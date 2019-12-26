<template>
  <div class="h-full">
    <div class="bg-white p-4 rounded shadow">
      <div class="flex items-center mb-4 text-sm text-gray-600">
        <inertia-link class="hover:underline" href="/clients">Clients</inertia-link>
        <span class="mx-2">></span>
        <inertia-link class="hover:underline" :href="client.path">{{client.company_name}}</inertia-link>
        <span class="mx-2">></span>
        <inertia-link class="hover:underline" :href="`${client.path}/projects`">Projects</inertia-link>
        <span class="mx-2">></span>
        <span>{{project.title}}</span>
      </div>
      <h2 class="text-2xl">{{project.title}}</h2>
    </div>
  </div>
</template>

<script>
import StandardLayout from "../../components/Layouts/StandardLayout";

export default {
  layout: StandardLayout,
  components: {
    StandardLayout
  },
  props: ["client", "project"]
};
</script>