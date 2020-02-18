<template>
  <div class="flex h-full">
    <div class="flex w-1/4 p-4 overflow-y-scroll bg-white rounded shadow min-w-122">
      <div class="flex-1 h-full">
        <div class="pb-4">
          <client-table
            class="w-full"
            :items="clients"
            :columns="['company_name','address','city','state']"
            :sortable="['company_name','address','city','state']"
            linkColumn="company_name"
            linkField="path"
          ></client-table>
        </div>
      </div>
    </div>
    <div class="flex w-3/4 pl-4 pr-1 mb-16 rounded">
      <div class="flex-1 h-full">
        <client-details :client="client"></client-details>
        <content-scroll>
          <div class="w-full p-4 mt-4 bg-white rounded shadow">
            <div class="flex items-center justify-between">
              <h4 class="text-xl">Recent Projects</h4>
              <div class="flex items-center">
                <inertia-link
                  :href="`/clients/${client.url_id}/projects`"
                  class="mr-4 text-gray-600 underline"
                >View All Projects</inertia-link>
                <button
                  class="flex items-center justify-center w-10 h-10 leading-none text-white rounded-full shadow fill-current bg-blue"
                  @click="openCreateProjectModal"
                >
                  <svg
                    class="w-10 h-10 font-bold text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                  >
                    <path
                      d="M11.5 16v-3.5H8a.5.5 0 0 1 0-1h3.5V8a.5.5 0 0 1 1 0v3.5H16a.5.5 0 0 1 0 1h-3.5V16a.5.5 0 0 1-1 0z"
                    />
                  </svg>
                </button>
              </div>
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
        </content-scroll>
      </div>
    </div>
  </div>
</template>

<script>
import StandardLayout from "../../components/Layouts/StandardLayout";
import ClientTable from "../../components/Clients/ClientTable";
import ClientDetails from "../../components/Clients/ClientDetails";
import ClientProjectsTable from "../../components/Clients/ClientProjectsTable";
import ContentScroll from "../../components/Layouts/ContentScroll";
import ProjectModal from "../../components/Projects/ProjectModal";

export default {
  layout: StandardLayout,
  components: {
    StandardLayout,
    ClientTable,
    ClientDetails,
    ClientProjectsTable,
    ContentScroll,
    ProjectModal
  },
  props: ["clients", "client"],
  methods: {
    openCreateProjectModal() {
      this.$modal.show(
        ProjectModal,
        {},
        {
          adaptive: true,
          height: "85%",
          width: "1000px",
          minHeight: 800,
          minWith: 400,
          scrollable: true,
          resizable: true
        }
      );
    }
  }
};
</script>