<template>
  <div class="flex">
    <div class="w-2/3 mr-8">
      <work-entry-table
        :items="project.work_entries"
        :columns="['start_time', 'end_time','duration', 'work_type', 'description', 'billable','billed']"
      ></work-entry-table>
    </div>
    <div class="flex flex-col w-1/3">
      <time-tracker :project="project"></time-tracker>
    </div>
  </div>
</template>

<script>
import WorkEntryTable from "../WorkEntry/WorkEntryTable";
import TimeTracker from "./TimeTracker";
export default {
  props: ["project"],
  components: { TimeTracker, WorkEntryTable }
};
</script>