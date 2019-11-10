<template>
  <standard-layout>
    <div class="flex">
      <div class="max-h-full w-2/5 flex-1 border-r-4 pr-4">
        <table-filter
          class="w-full"
          :items="clients"
          :columns="['company_name','phone_number', 'address','city','state']"
          :sortable="['company_name','city','state']"
          @clickedItem="setActiveClient"
        ></table-filter>
      </div>
      <div class="h-full w-2/3 pl-4">
        <client-information :client="activeClient" v-if="activeClient"></client-information>
      </div>
    </div>
  </standard-layout>
</template>

<script>
import StandardLayout from "../../components/StandardLayout";
import TableFilter from "../../components/TableFilter";
import ClientInformation from "../../components/Clients/ClientInformation";

export default {
  components: { StandardLayout, TableFilter, ClientInformation },
  props: ["clients"],
  data() {
    return {
      activeClient: null
    };
  },
  methods: {
    setActiveClient(client) {
      this.activeClient = client;
    }
  }
};
</script>