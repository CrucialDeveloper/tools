<template>
  <div>
    <div class="flex items-center justify-between">
      <div class="flex items-center mr-4">
        <button
          class="w-5 h-5 mr-4 fill-current"
          @click="setView('tile')"
          :class="[view==='tile' ? 'text-gray-500' :'text-gray-200']"
          title="View as Tiles"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path
              d="M0 0h9v9H0V0zm2 2v5h5V2H2zm-2 9h9v9H0v-9zm2 2v5h5v-5H2zm9-13h9v9h-9V0zm2 2v5h5V2h-5zm-2 9h9v9h-9v-9zm2 2v5h5v-5h-5z"
            />
          </svg>
        </button>
        <button
          class="w-6 h-6 mr-4 fill-current"
          @click="setView('kanban')"
          :class="[view==='kanban' ? 'text-gray-500' :'text-gray-200']"
          title="View as Kanban"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12 4H8v12h4V4zm2 0v12h4V4h-4zM6 4H2v12h4V4zM0 2h20v16H0V2z" />
          </svg>
        </button>
        <button
          class="w-6 h-6 mr-4 fill-current"
          @click="setView('table')"
          :class="[view==='table' ? 'text-gray-500' :'text-gray-200']"
          title="View as Table"
        >
          <svg viewBox="0 0 1664 1408">
            <path
              d="M512 1248v-192q0-14-9-23t-23-9H160q-14 0-23 9t-9 23v192q0 14 9 23t23 9h320q14 0 23-9t9-23zm0-384V672q0-14-9-23t-23-9H160q-14 0-23 9t-9 23v192q0 14 9 23t23 9h320q14 0 23-9t9-23zm512 384v-192q0-14-9-23t-23-9H672q-14 0-23 9t-9 23v192q0 14 9 23t23 9h320q14 0 23-9t9-23zM512 480V288q0-14-9-23t-23-9H160q-14 0-23 9t-9 23v192q0 14 9 23t23 9h320q14 0 23-9t9-23zm512 384V672q0-14-9-23t-23-9H672q-14 0-23 9t-9 23v192q0 14 9 23t23 9h320q14 0 23-9t9-23zm512 384v-192q0-14-9-23t-23-9h-320q-14 0-23 9t-9 23v192q0 14 9 23t23 9h320q14 0 23-9t9-23zm-512-768V288q0-14-9-23t-23-9H672q-14 0-23 9t-9 23v192q0 14 9 23t23 9h320q14 0 23-9t9-23zm512 384V672q0-14-9-23t-23-9h-320q-14 0-23 9t-9 23v192q0 14 9 23t23 9h320q14 0 23-9t9-23zm0-384V288q0-14-9-23t-23-9h-320q-14 0-23 9t-9 23v192q0 14 9 23t23 9h320q14 0 23-9t9-23zm128-320v1088q0 66-47 113t-113 47H160q-66 0-113-47T0 1248V160Q0 94 47 47T160 0h1344q66 0 113 47t47 113z"
            />
          </svg>
        </button>
        <button
          class="w-6 h-6 mr-4 rotate-90 fill-current"
          @click="setView('gantt')"
          :class="[view==='gantt' ? 'text-gray-500' :'text-gray-200']"
          title="View as Gantt"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M1 10h3v10H1V10zM6 0h3v20H6V0zm5 8h3v12h-3V8zm5-4h3v16h-3V4z" />
          </svg>
        </button>
      </div>
      <div>
        <button
          class="flex items-center justify-center w-10 h-10 leading-none text-white rounded-full shadow fill-current bg-blue"
          @click="newTask"
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
    <div class="max-h-full mt-4">
      <content-filter
        v-if="view==='tile'"
        class="w-full h-full mt-4 overflow-y-scroll"
        :items="tasks"
        :filters="project.task_status_options"
        :searchable="['title','description']"
      >
        <div class="flex flex-wrap items-stretch -mx-2" slot-scope="{items}">
          <div
            class="flex items-stretch w-full p-2 mx-2 mb-2 md:min-w-70 md:w-1/5 md:p-0 md:mb-2 md:mt-2 md:mx-2"
            v-for="item in items"
            :key="item.id"
          >
            <task-card class="flex-1" :task="item"></task-card>
          </div>
        </div>
      </content-filter>

      <kanban-board
        class="w-full"
        :items="tasks"
        :parent="project"
        :available_status="project.task_status_options"
        v-if="view==='kanban'"
      >
        <div slot-scope="{item}">
          <task-card class="mt-4" :task="item" :project="project"></task-card>
        </div>
      </kanban-board>
    </div>
  </div>
</template>

<script>
import ContentFilter from "../UI/ContentFilter";
import KanbanBoard from "../UI/KanbanBoard";
import TaskCard from "./TaskCard";
import TaskModal from "./TaskModal";

export default {
  components: { ContentFilter, KanbanBoard, TaskCard, TaskModal },
  props: ["client", "project", "tasks"],
  data() {
    return {
      view: "kanban"
    };
  },
  methods: {
    setView(view) {
      localStorage.setItem("tasksView", view);
      this.view = view;
    },
    newTask() {
      this.$modal.show(
        TaskModal,
        { project: this.project },
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
  created() {
    this.view = localStorage.getItem("tasksView")
      ? localStorage.getItem("tasksView")
      : "tile";
  }
};
</script>