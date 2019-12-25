<template>
  <div class="flex h-full">
    <div class="flex w-2/5 h-full pb-4 overflow-y-scroll">
      <div class="max-h-full flex-1 pr-4 mb-4 border-r-4">
        <div class="bg-white p-4 rounded shadow">
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
    <div class="w-3/5 pl-4 h-full">
      <div class="p-4 bg-white rounded shadow">
        <client-information :client="client"></client-information>
      </div>
    </div>
  </div>
</template>

<script>
import StandardLayout from "../../components/StandardLayout";
import ClientTable from "../../components/Clients/ClientTable";
import ClientInformation from "../../components/Clients/ClientInformation";

export default {
  layout: StandardLayout,
  components: { StandardLayout, ClientTable, ClientInformation },
  props: ["clients", "client"]
};
</script>