<template>
  <button
    class="w-full p-2 bg-white rounded shadow"
    :class="{'border-l-6 border-red-500': task.past_due}"
    @click="editTask"
  >
    <div class="flex items-start justify-between">
      <h2 class="mr-2 text-left">{{task.title}}</h2>
      <div :class="priorityIndicator">{{task.priority}}</div>
    </div>
    <div class="flex items-center justify-between mt-4">
      <div class="mr-4">{{task.status}}</div>
      <div>{{formatDate(task.due_date)}}</div>
    </div>
  </button>
</template>

<script>
import { format } from "date-fns";
import TaskModal from "./TaskModal";

export default {
  name: "TaskCard",
  components: { TaskModal },
  props: ["project", "client", "task"],
  data() {
    return {};
  },
  methods: {
    formatDate(date) {
      return `${format(new Date(date), "yyyy-MM-dd")}`;
    },
    editTask() {
      this.$modal.show(
        TaskModal,
        { editTask: this.task, project: this.$page.project },
        {
          adaptive: true,
          width: "1000px",
          minHeight: 800,
          minWith: 400,
          scrollable: true,
          resizable: true
        }
      );
    }
  },
  computed: {
    priorityIndicator() {
      let colors = {
        P1: "text-red-500",
        P2: "text-yellow-500",
        P3: "text-green-500"
      };
      return colors[this.task.priority];
    }
  }
};
</script>