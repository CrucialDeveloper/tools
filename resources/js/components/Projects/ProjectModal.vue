<template>
  <div class="flex flex-col h-full p-4 overflow-x-hidden">
    <h3
      class="mb-4 text-2xl"
    >{{(editProject === undefined || Object.keys(editProject).length ===0)? 'New Project' : 'Edit Project'}}</h3>
    <tabs-nav class="flex-grow h-full pb-16 overflow-x-hidden">
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
                :options="project.task_status_options"
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
        <sort-list v-model="project.task_status_options"></sort-list>
      </tab-panel>
      <tab-panel name="Work Types &amp; Rates">
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center flex-1 mr-4">
            <label for="new_work_type" class="mr-2 font-bold">Work Type:</label>
            <input
              class="flex-1 w-full p-2 mr-4 border rounded"
              id="new_work_type"
              ref="new_work_type"
              type="text"
              :class="project.errors.errors.work_type ? 'border-red':''"
              v-model="new_work_type"
            />
          </div>
          <div class="flex items-center">
            <label for="new_status" class="mr-2 font-bold">Work Rate:</label>
            <input
              class="flex-1 w-full p-2 mr-4 border rounded"
              id="new_work_rate"
              ref="new_work_rate"
              type="text"
              :class="project.errors.errors.work_type ? 'border-red':''"
              v-model="new_work_rate"
            />
          </div>
          <button
            class="p-2 bg-gray-300 border rounded hover:bg-gray"
            @click="addWorkType"
          >Add Work Type</button>
        </div>
        <div v-if="project.work_type.length >0">
          <ol>
            <draggable :list="project.work_type" group="default">
              <li
                class="flex items-center mb-1"
                v-for="(type, index) in project.work_type"
                :key="type[0]"
              >
                <span class="w-4 mr-2">{{index + 1}}.</span>
                <span
                  class="flex items-center justify-between w-56 px-2 py-1 mb-2 mr-2 text-white rounded bg-gray"
                >
                  <span class="mr-2 rounded">{{type[0]}} @ ${{type[2]}}/hour</span>
                  <button class="w-3 h-3 fill-current" @click="removeWorkType(index)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"
                      />
                    </svg>
                  </button>
                </span>
              </li>
            </draggable>
          </ol>
        </div>
      </tab-panel>
    </tabs-nav>
    <div class="flex items-center justify-between w-full mt-auto">
      <button class="text-gray-600 underline" @click="reset">Cancel</button>
      <button
        class="px-4 py-2 text-white rounded bg-blue"
        @click="saveProject"
        v-if="editProject === undefined || Object.keys(editProject).length===0"
      >Save</button>
      <button class="px-4 py-2 text-white rounded bg-blue" @click="updateProject" v-else>Save</button>
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
import SortList from "../UI/SortList";

export default {
  components: {
    TabsNav,
    TabPanel,
    SelectInput,
    DatePicker,
    SortList,
    ContentEditor
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
        task_status_options: [["Not Started", "In Progress", "Completed"]],
        work_type: [
          ["Standard", "Standard", 50],
          ["Coding", "Coding", 50],
          ["Spike", "Spike", 35],
          ["Meeting", "Meeting", 50],
          ["Bug Fix", "Bug Fix", 35],
          ["Other", "Other", 40]
        ]
      }),
      new_status: "",
      new_work_type: "",
      new_work_rate: ""
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
    addStatus() {
      if (
        this.new_status &&
        !this.project.task_status_options.includes(this.new_status)
      ) {
        this.project.task_status_options.push([
          this.new_status,
          this.new_status
        ]);
      }
      this.new_status = "";
      this.$refs.new_status.focus();
    },
    removeStatus(index) {
      this.project.task_status_options.splice(index, 1);
    },
    addWorkType() {
      if (
        this.new_work_type &&
        this.new_work_rate &&
        !this.project.work_type.includes(this.new_work_type)
      ) {
        this.project.work_type.push([
          this.new_work_type,
          this.new_work_type,
          this.new_work_rate
        ]);
      }
      this.new_work_type = "";
      this.new_work_rate = "";
      this.$refs.new_work_type.focus();
    },
    removeWorkType(index) {
      this.project.work_type.splice(index, 1);
    }
  },
  created() {
    if (this.editProject) {
      this.project = new Form({ ...this.editProject });
    }
  }
};
</script>