<template>
  <div class="flex h-full">
    <div class="flex w-1/4 p-4 mr-4 overflow-y-scroll bg-white rounded shadow min-w-122">
      <div class="flex-1 h-full">
        <div class="pb-4">
          <client-table
            class="w-full"
            :items="clients"
            :columns="['company_name','address','city','state']"
            :sortable="['company_name','city','state']"
            linkColumn="company_name"
            linkField="path"
          ></client-table>
        </div>
      </div>
    </div>
    <div class="flex w-3/4 pl-4 pr-1 mb-16 rounded">
      <div class="flex-1 h-full">
        <client-details :client="client"></client-details>
        <div class="w-full p-4 mt-4 bg-white rounded shadow">
          <div class="flex items-center justify-between">
            <h4 class="text-xl">Recent Projects</h4>
            <inertia-link
              :href="`/clients/${client.url_id}/projects`"
              class="text-gray-600 underline"
            >View All Projects</inertia-link>
          </div>
          <client-projects-table
            :items="client.projects"
            :columns="['title','description','status', 'start_date','due_date', 'priority']"
            :dateColumns="['start_date','due_date']"
            linkColumn="title"
            linkField="path"
            :paginate="false"
          ></client-projects-table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import StandardLayout from "../../components/Layouts/StandardLayout";
import ClientTable from "../../components/Clients/ClientTable";
import ClientDetails from "../../components/Clients/ClientDetails";
import ClientProjectsTable from "../../components/Clients/ClientProjectsTable";

export default {
  layout: StandardLayout,
  components: {
    StandardLayout,
    ClientTable,
    ClientDetails,
    ClientProjectsTable
  },
  props: ["clients", "client"]
};
</script>