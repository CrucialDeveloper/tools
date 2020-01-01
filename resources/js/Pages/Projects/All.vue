<template>
  <div class="flex h-full">
    <div class="flex max-h-full bg-white p-4 rounded shadow overflow-y-scroll mb-16 w-full">
      <div class="h-full flex-1">
        <h2 class="text-2xl">All Projects</h2>
        <div class="pb-4">
          <project-table
            class="h-full"
            :items="projects"
            :columns="['title','description','status', 'client:client.company_name','start_date','due_date', 'priority']"
            :dateColumns="['start_date','due_date']"
            :linkColumn="['title', 'client:client.company_name']"
            :linkField="['path', 'client.path']"
          ></project-table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import StandardLayout from "../../components/Layouts/StandardLayout";
import ProjectTable from "../../components/Projects/ProjectTable";

export default {
  layout: StandardLayout,
  components: {
    StandardLayout,
    ProjectTable
  },
  props: ["projects"]
};
</script>