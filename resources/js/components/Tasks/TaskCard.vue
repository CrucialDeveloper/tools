<template>
  <inertia-link
    :href="viewPath()"
    class="card bg-blue-300 flex flex-col items-stretch justify-between rounded p-2 mb-4 shadow-md"
    :class="{'border-l-4 border-red-800': task.past_due}"
  >
    <div>
      <div class="flex justify-between">
        <h2 class="font-bold block capitalize text-center w-full">{{task.title}}</h2>
      </div>
      <span class="font-sm block flex-grow" v-html="task.description"></span>
    </div>
    <div class="text-sm border-t-2 border-gray-700 mt-2 pt-2">
      <div>
        <span class="font-bold">Due:</span>
        {{formatDate(task.due_date)}}
      </div>
      <div class="flex items-center justify-between">
        <div class="mr=2">
          <span class="font-bold">Status:</span>
          {{task.status}}
        </div>
        <div>
          <span class="font-bold">Priority:</span>
          {{task.priority}}
        </div>
      </div>
    </div>
  </inertia-link>
</template>

<script>
export default {
  name: "TaskCard",
  props: ["project", "client", "task"],
  data() {
    return {};
  },
  methods: {
    configPath(task) {
      // return `/b/${this.board.slug}/p/${this.project.slug}/t/${task.slug}/edit`;
    },
    viewPath() {
      return this.task.path;
    },
    formatDate(date) {
      // return `${dateFns.format(date, "MM/DD/YYYY")}`;
    }
  }
};
</script>