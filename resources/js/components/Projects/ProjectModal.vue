<template>
  <div class="flex flex-col h-full p-4 overflow-x-hidden">
    <h3
      class="mb-4 text-2xl"
    >{{(editProject === undefined || Object.keys(editProject).length ===0)? 'New Project' : 'Edit Project'}}</h3>
    <tabs-nav class="flex-grow h-full pb-16 overflow-x-hidden" :saveLast="false">
      <tab-panel name="Details" class="h-full">
        <div class="mb-4 overflow-y-scroll">
          <label for="name" class="block font-bold">
            Title:
            <span
              class="ml-2 text-sm font-normal text-red"
              v-if="project.errors.errors.title"
            >{{project.errors.errors.title[0]}}</span>
          </label>
          <input
            class="w-full p-2 border rounded"
            id="name"
            type="text"
            :class="project.errors.errors.title ? 'border-red':''"
            v-model="project.title"
          />
        </div>
        <div class="mb-4">
          <label for="description" class="block font-bold">
            Description:
            <span
              class="ml-2 text-sm font-normal text-red"
              v-if="project.errors.errors.description"
            >{{project.errors.errors.description[0]}}</span>
          </label>
          <content-editor v-model="project.description" :default="project.description"></content-editor>
        </div>
        <div class="flex flex-col md:flex-row md:items-center">
          <div class="w-full mr-8 md:w-1/2">
            <div class="w-full mb-4">
              <label for="status" class="flex-shrink-0 mr-2 font-bold">
                Status:
                <span
                  class="ml-2 text-sm font-normal text-red"
                  v-if="project.errors.errors.status"
                >{{project.errors.errors.status[0]}}</span>
              </label>
              <select-input
                :options="client.project_status_options"
                placeholder="Select Status ..."
                v-model="project.status"
                :class="project.errors.errors.status ? 'border-red border rounded':''"
              ></select-input>
            </div>
          </div>
          <div class="w-full md:w-1/2">
            <div class="mb-4">
              <label for="status" class="flex-shrink-0 mr-2 font-bold">
                Priority:
                <span
                  class="ml-2 text-sm font-normal text-red"
                  v-if="project.errors.errors.priority"
                >{{project.errors.errors.priority[0]}}</span>
              </label>
              <select-input
                :options="['P1','P2','P3']"
                placeholder="Select Priority ..."
                v-model="project.priority"
                :class="project.errors.errors.priority ? 'border-red border rounded':''"
              ></select-input>
            </div>
          </div>
        </div>
        <div class="flex flex-col md:flex-row md:items-center">
          <div class="w-full mb-4 mr-8 md:w-1/2">
            <label for="start_date" class="flex-shrink-0 mr-2 font-bold">
              Start Date:
              <span
                class="ml-2 text-sm font-normal text-red"
                v-if="project.errors.errors.start_date"
              >{{project.errors.errors.start_date[0]}}</span>
            </label>
            <div>
              <date-picker
                class="p-2"
                :class="project.errors.errors.start_date ? 'border-red border rounded':'border rounded w-full'"
                v-model="project.start_date"
              ></date-picker>
            </div>
          </div>
          <div class="w-full mb-4 md:w-1/2">
            <label for="due_date" class="flex-shrink-0 mr-2 font-bold">
              Due Date:
              <span
                class="ml-2 text-sm font-normal text-red"
                v-if="project.errors.errors.due_date"
              >{{project.errors.errors.due_date[0]}}</span>
            </label>
            <div>
              <date-picker
                class="p-2"
                :class="project.errors.errors.due_date ? 'border-red border rounded':'border rounded w-full'"
                v-model="project.due_date"
              ></date-picker>
            </div>
          </div>
        </div>
      </tab-panel>
      <tab-panel name="Configure" class="h-full">
        <sort-status-list v-model="project.task_status_options"></sort-status-list>
      </tab-panel>
      <tab-panel name="Work Types &amp; Rates">
        <sort-work-type-list v-model="project.work_type"></sort-work-type-list>
      </tab-panel>
    </tabs-nav>
    <div class="flex items-center justify-between w-full">
      <button class="flex-1 mr-4 text-red-500 underline" @click="deleteProject">Delete</button>
      <div class="flex items-center justify-end w-full mt-auto">
        <button class="mr-4 text-gray-600 underline" @click="reset">Cancel</button>
        <button
          class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
          @click="saveProject"
          v-if="editProject === undefined || Object.keys(editProject).length===0"
        >Save</button>
        <button
          class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
          @click="updateProject"
          v-else
        >Save</button>
      </div>
    </div>
  </div>
</template>

<script>
import TabsNav from "../UI/Tabs/TabsNav";
import TabPanel from "../UI/Tabs/TabPanel";
import SelectInput from "../UI/SelectInput";
import DatePicker from "../UI/DatePicker";
import ContentEditor from "../UI/ContentEditor";
import Form from "@johnlowery74/crucial-form";
import SortStatusList from "../UI/SortStatusList";
import SortWorkTypeList from "../UI/SortWorkTypeList";

export default {
  components: {
    TabsNav,
    TabPanel,
    SelectInput,
    DatePicker,
    SortStatusList,
    ContentEditor,
    SortWorkTypeList
  },
  props: ["client", "editProject"],
  data() {
    return {
      project: new Form({
        title: "",
        description: "",
        status: "",
        start_date: "",
        due_date: "",
        priority: "",
        task_status_options: this.client.project_status_options,
        work_type: this.client.work_type
      })
    };
  },
  methods: {
    reset() {
      this.project = new Form({});
      this.$modal.hide(this.$parent.name);
    },
    saveProject() {
      this.project
        .post(this.client.path + "/projects", this.project)
        .then(response => {
          this.$inertia.visit(response);
          this.reset();
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    updateProject() {
      this.project
        .patch(this.project.path, this.project)
        .then(response => {
          this.$inertia.visit(response);
          this.reset();
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    deleteProject() {
      this.project
        .delete(this.project.path)
        .then(response => {
          this.$inertia.visit(response);
          this.reset();
        })
        .catch(errors => {
          console.log(errors);
        });
    }
  },
  created() {
    if (this.editProject) {
      this.project = new Form({ ...this.editProject });
    }

    if (this.project.work_type.length === 0) {
      this.project.work_type = this.client.work_type;
    }
  }
};
</script>