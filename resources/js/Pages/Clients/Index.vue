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
  </div>
</template>

<script>
import StandardLayout from "../../components/Layouts/StandardLayout";
import ClientTable from "../../components/Clients/ClientTable";

export default {
  layout: StandardLayout,
  components: { StandardLayout, ClientTable },
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