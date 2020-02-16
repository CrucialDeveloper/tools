<template>
  <inertia-link
    :href="viewPath()"
    class="flex flex-col items-stretch justify-between p-2 mb-4 bg-white rounded shadow-md"
    :class="{'border-l-4 border-red-800': project.past_due}"
  >
    <div>
      <div class="flex justify-between">
        <h2 class="block w-full font-bold text-center capitalize">{{project.title}}</h2>
      </div>
      <span class="flex-grow block font-sm" v-html="project.description"></span>
    </div>
    <div class="pt-2 mt-2 text-sm border-t-2 border-gray-700">
      <div class="flex items-center justify-between">
        <div class="mr-2">{{taskCount(project)}}</div>
        <div>{{formatDate(project.due_date)}}</div>
      </div>
      <div class="flex items-center justify-between">
        <div class="mr-2">{{project.status}}</div>
        <div>{{project.priority}}</div>
      </div>
    </div>
  </inertia-link>
</template>

<script>
import { format } from "date-fns";
export default {
  name: "ProjectCard",
  props: ["project", "client"],
  data() {
    return {};
  },
  methods: {
    taskCount(project) {
      return project.tasks.length + " Tasks";
    },
    formatDate(date) {
      return format(new Date(date), "y-MM-dd");
    },
    viewPath() {
      return this.project.path;
    }
  }
};
</script>