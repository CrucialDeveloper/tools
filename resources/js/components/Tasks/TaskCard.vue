<template>
  <button
    class="min-w-full p-2 bg-white rounded shadow-md"
    :class="{'border-l-4 border-red-800': task.past_due}"
    @click="editTask"
  >
    <div class="flex flex-row items-start justify-between">
      <h2 class="text-left capitalize">{{task.title}}</h2>
      <div class="ml-4" :class="priorityIndicator">{{task.priority}}</div>
    </div>
    <div class="flex items-center justify-between pt-2 mt-2 text-sm">
      <div class="flex items-center">
        <span class="w-6 h-6 mr-2 text-gray-500 fill-current">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
            <path
              d="M49.984 27.452c-12.453 0-22.548 10.095-22.548 22.548 0 12.453 10.095 22.548 22.548 22.548S72.531 62.453 72.531 50c0-12.453-10.095-22.548-22.547-22.548zm0 35.156c-6.964 0-12.609-5.645-12.609-12.608 0-6.964 5.645-12.609 12.609-12.609S62.592 43.036 62.592 50c0 6.963-5.645 12.608-12.608 12.608z"
            />
            <path
              d="M50 12.5c-20.712 0-37.5 16.793-37.5 37.502C12.5 70.712 29.288 87.5 50 87.5s37.5-16.788 37.5-37.498C87.5 29.293 70.712 12.5 50 12.5zm0 65.061c-15.199 0-27.56-12.362-27.56-27.559C22.44 34.807 34.802 22.44 50 22.44c15.198 0 27.56 12.367 27.56 27.562 0 15.196-12.362 27.559-27.56 27.559z"
            />
            <circle cx="49.984" cy="50" r="7.621" />
          </svg>
        </span>
        <span>{{formatDate(task.due_date)}}</span>
      </div>
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
      let colors = { P1: "text-red", P2: "text-yellow", P3: "text-green" };
      return colors[this.task.priority];
    }
  }
};
</script>