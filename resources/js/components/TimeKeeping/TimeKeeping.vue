<template>
  <div class="flex">
    <div class="w-2/3">Time Keeping Table</div>
    <div class="w-1/3 flex flex-col">
      <time-tracker :project="project"></time-tracker>
    </div>
  </div>
</template>

<script>
import TimeTracker from "./TimeTracker";
export default {
  props: ["project"],
  components: { TimeTracker }
};
</script>