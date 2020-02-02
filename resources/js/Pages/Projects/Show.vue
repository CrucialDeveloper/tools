<template>
  <div>
    <div class="flex items-start mb-2 text-sm text-gray-600">
      <inertia-link class="hover:underline" href="/clients">Clients</inertia-link>
      <span class="mx-2">></span>
      <inertia-link class="hover:underline" :href="client.path">{{client.company_name}}</inertia-link>
      <span class="mx-2">></span>
      <inertia-link class="hover:underline" :href="`${client.path}/projects`">Projects</inertia-link>
      <span class="mx-2">></span>
      <span>{{project.title}}</span>
    </div>
    <div class="p-4 bg-white rounded shadow">
      <div class="flex items-center justify-between">
        <h2 class="mr-4 text-2xl">{{project.title}}</h2>
        <button class="w-5 h-5 text-gray-500" @click="editProject">
          <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <path
              d="M6 34.5V42h7.5l22.13-22.13-7.5-7.5L6 34.5zm35.41-20.41c.78-.78.78-2.05 0-2.83l-4.67-4.67c-.78-.78-2.05-.78-2.83 0l-3.66 3.66 7.5 7.5 3.66-3.66z"
            />
          </svg>
        </button>
      </div>
      <p v-html="project.description"></p>
    </div>
    <div class="flex w-full mt-4">
      <div class="w-4/5">
        <content-scroll class="flex-grow-0">
          <div class="p-4 mr-4 bg-white rounded shadow">
            <tabs-nav class="h-full">
              <tab-panel name="Dashboard">
                <div class="px-4 pb-4 mt-4">Dashboard</div>
              </tab-panel>
              <tab-panel class="max-h-full" name="Tasks">
                <task-views
                  class="max-h-full"
                  :client="client"
                  :project="project"
                  :tasks="project.tasks"
                ></task-views>
              </tab-panel>

              <tab-panel name="Files">
                <div class="px-4 pb-4 mt-4">Files</div>
              </tab-panel>
              <tab-panel name="Work Entries">
                <work-entry :project="project"></work-entry>
              </tab-panel>
            </tabs-nav>
          </div>
        </content-scroll>
      </div>
      <div class="w-1/5">
        <content-scroll>
          <div class="min-h-full p-4 mb-4 bg-white rounded shadow">
            <comments-view :comments="project.comments"></comments-view>
          </div>
        </content-scroll>
      </div>
    </div>
  </div>
</template>

<script>
import StandardLayout from "../../components/Layouts/StandardLayout";
import ProjectModal from "../../components/Projects/ProjectModal";
import TabsNav from "../../components/UI/Tabs/TabsNav";
import TabPanel from "../../components/UI/Tabs/TabPanel";
import TaskViews from "../../components/Tasks/TaskViews";
import WorkEntry from "../../components/WorkEntry/WorkEntry";
import ContentScroll from "../../components/Layouts/ContentScroll";
import CommentsView from "../../components/Comments/CommentsView";

export default {
  layout: StandardLayout,
  components: {
    StandardLayout,
    TabsNav,
    TabPanel,
    TaskViews,
    WorkEntry,
    ContentScroll,
    CommentsView
  },
  props: ["client", "project"],
  methods: {
    editProject() {
      this.$modal.show(
        ProjectModal,
        { client: this.client, editProject: this.project },
        {
          adaptive: true,
          height: "85%",
          width: "1000px",
          minHeight: 800,
          minWith: 400,
          scrollable: true,
          resizable: true
        }
      );
    }
  }
};
</script>