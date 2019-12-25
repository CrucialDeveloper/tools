<template>
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
</template>

<script>
import StandardLayout from "../../components/StandardLayout";
import ClientTable from "../../components/Clients/ClientTable";
import ClientInformation from "../../components/Clients/ClientInformation";

export default {
  layout: StandardLayout,
  components: { StandardLayout, ClientTable, ClientInformation },
  props: ["clients"],
  data() {
    return {
      activeClient: null
    };
  },
  methods: {
    setActiveClient(client) {
      this.activeClient = client;
      window.location.hash = this.activeClient.url_id;
    }
  },
  mounted() {
    if (window.location.hash.length > 0) {
      this.activeClient = this.clients.filter(client => {
        console.log(window.location.hash);
        return client.url_id === window.location.hash.slice(1);
      })[0];
    }
  }
};
</script>