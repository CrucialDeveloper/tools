<template>
  <standard-layout>
    <div class="flex">
      <div class="max-h-full w-2/5 flex-1 border-r-4 pr-4">
        <client-table
          class="w-full"
          :items="clients"
          :columns="['company_name','phone_number', 'address','city','state']"
          :sortable="['company_name','city','state']"
          linkColumn="company_name"
          linkField="path"
        ></client-table>
      </div>
      <div class="h-full w-2/3 pl-4">
        <client-information :client="client"></client-information>
      </div>
    </div>
  </standard-layout>
</template>

<script>
import StandardLayout from "../../components/StandardLayout";
import ClientTable from "../../components/Clients/ClientTable";
import ClientInformation from "../../components/Clients/ClientInformation";

export default {
  components: { StandardLayout, ClientTable, ClientInformation },
  props: ["clients", "client"]
};
</script>