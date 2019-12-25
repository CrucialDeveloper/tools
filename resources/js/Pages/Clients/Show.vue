<template>
  <div class="flex h-full">
    <div class="flex w-2/5 max-h-full bg-white p-4 rounded shadow overflow-y-scroll mr-8 mb-16">
      <div class="h-full flex-1 pr-4">
        <div class="pb-4">
          <client-table
            class="w-full"
            :items="clients"
            :columns="['company_name','phone_number', 'address','city','state']"
            :sortable="['company_name','city','state']"
            linkColumn="company_name"
            linkField="path"
          ></client-table>
        </div>
      </div>
    </div>
    <div class="w-3/5 max-h-full overflow-y-scroll mb-16">
      <client-details :client="client"></client-details>
      <client-projects-table
        class="w-full bg-white mt-4 p-4 rounded shadow"
        :items="client.projects"
        :columns="['title','description','status', 'start_date','due_date', 'priority']"
        linkColumn="title"
        linkField="path"
      ></client-projects-table>
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