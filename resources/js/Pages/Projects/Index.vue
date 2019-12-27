<template>
  <div class="flex h-full">
    <div class="flex max-h-full bg-white p-4 rounded shadow overflow-y-scroll mb-16 w-full">
      <div class="h-full flex-1">
        <div class="flex items-center mb-4 text-sm text-gray-600">
          <inertia-link class="hover:underline" href="/clients">Clients</inertia-link>
          <span class="mx-2">></span>
          <inertia-link class="hover:underline" :href="client.path">{{client.company_name}}</inertia-link>
          <span class="mx-2">></span>
          <span>Projects</span>
        </div>
        <h2 class="text-2xl">Client Projects</h2>
        <div class="pb-4">
          <client-projects-table
            :items="projects"
            :columns="['title','description','status', 'start_date','due_date', 'priority']"
            :dateColumns="['start_date','due_date']"
            linkColumn="title"
            linkField="path"
          ></client-projects-table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import StandardLayout from "../../components/Layouts/StandardLayout";
import ClientProjectsTable from "../../components/Clients/ClientProjectsTable";

export default {
  layout: StandardLayout,
  components: {
    StandardLayout,
    ClientProjectsTable
  },
  props: ["client", "projects"]
};
</script>