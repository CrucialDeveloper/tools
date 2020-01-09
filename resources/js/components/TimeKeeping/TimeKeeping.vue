<template>
  <div class="flex" style="height:654px">
    <div class="w-2/3 mr-8 overflow-y-scroll">
      <timekeeping-table
        :items="project.time_keepings"
        :columns="['start_time', 'end_time','duration', 'work_type', 'description', 'billable','billed']"
      ></timekeeping-table>
    </div>
    <div class="w-1/3 flex flex-col">
      <time-tracker :project="project"></time-tracker>
    </div>
  </div>
</template>

<script>
import TimekeepingTable from "../TimeKeeping/TimekeepingTable";
import TimeTracker from "./TimeTracker";
export default {
  props: ["project"],
  components: { TimeTracker, TimekeepingTable }
};
</script>