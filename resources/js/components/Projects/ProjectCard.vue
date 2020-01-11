<template>
  <inertia-link
    :href="viewPath()"
    class="flex flex-col items-stretch justify-between p-2 mb-4 bg-blue-300 rounded shadow-md"
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
        <div class="mr-2">
          <span class="font-bold">Tasks:</span>
          {{taskCount(project)}}
        </div>
        <div>
          <span class="font-bold">Due:</span>
          {{formatDate(project.due_date)}}
        </div>
      </div>
      <div class="flex items-center justify-between">
        <div class="mr-2">
          <span class="font-bold">Status:</span>
          {{project.status}}
        </div>
        <div>
          <span class="font-bold">Priority:</span>
          {{project.priority}}
        </div>
      </div>
    </div>
  </inertia-link>
</template>

<script>
export default {
  name: "ProjectCard",
  props: ["project", "client"],
  data() {
    return {};
  },
  methods: {
    taskCount(project) {
      // return project.tasks.length;
    },
    formatDate(date) {
      // return `${dateFns.format(date, "MM/DD/YYYY")}`;
    },
    viewPath() {
      return this.project.path;
    }
  }
};
</script>