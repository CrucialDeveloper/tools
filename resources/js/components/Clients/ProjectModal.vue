<template>
  <div class="p-4">
    <h3
      class="text-2xl mb-4"
    >{{(editProject === undefined || Object.keys(editProject).length ===0)? 'New Project' : 'Edit Project'}}</h3>
    <tabs-nav>
      <tab-panel>
        <div class="mb-4">
          <label for="name" class="font-bold block">
            Title:
            <span
              class="ml-2 text-sm text-red font-normal"
              v-if="project.errors.errors.title"
            >{{project.errors.errors.title[0]}}</span>
          </label>
          <input
            class="p-2 rounded border-2 w-full"
            id="name"
            type="text"
            :class="project.errors.errors.title ? 'border-red':''"
            v-model="project.title"
          />
        </div>
        <div class="mb-4">
          <label for="description" class="font-bold block">
            Description:
            <span
              class="ml-2 text-sm text-red font-normal"
              v-if="project.errors.errors.description"
            >{{project.errors.errors.description[0]}}</span>
          </label>
          <textarea
            cols="30"
            rows="10"
            class="p-2 rounded border-2 w-full"
            v-model="project.descripton"
          ></textarea>
        </div>
        <div class="flex flex-col md:flex-row md:items-center">
          <div class="mr-8 w-full md:w-1/2">
            <div class="mb-4 w-full">
              <label for="status" class="mr-2 flex-shrink-0 font-bold">
                Status:
                <span
                  class="ml-2 text-sm text-red font-normal"
                  v-if="project.errors.errors.status"
                >{{project.errors.errors.status[0]}}</span>
              </label>
              <select-input
                :options="project.available_status"
                placeholder="Select Status ..."
                v-model="project.status"
                :class="project.errors.errors.status ? 'border-red border-2 rounded':''"
              ></select-input>
            </div>
          </div>
          <div class="w-full md:w-1/2">
            <div class="mb-4">
              <label for="status" class="mr-2 flex-shrink-0 font-bold">
                Priority:
                <span
                  class="ml-2 text-sm text-red font-normal"
                  v-if="project.errors.errors.priority"
                >{{project.errors.errors.priority[0]}}</span>
              </label>
              <select-input
                :options="[['P1','P1'],['P2','P2'],['P3','P3']]"
                placeholder="Select Priority ..."
                v-model="project.priority"
                :class="project.errors.errors.priority ? 'border-red border-2 rounded':''"
              ></select-input>
            </div>
          </div>
        </div>
        <div class="flex flex-col md:flex-row md:items-center">
          <div class="mr-8 w-full md:w-1/2 mb-4">
            <label for="start_date" class="mr-2 flex-shrink-0 font-bold">
              Start Date:
              <span
                class="ml-2 text-sm text-red font-normal"
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
          <div class="w-full md:w-1/2 mb-4">
            <label for="due_date" class="mr-2 flex-shrink-0 font-bold">
              Due Date:
              <span
                class="ml-2 text-sm text-red font-normal"
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
      <tab-panel name="Configure">
        <div class="mb-4">
          <label for="new_status" class="font-bold block">
            Availble Task Status:
            <span
              class="ml-2 text-sm text-red font-normal"
              v-if="project.errors.errors.available_status"
            >{{project.errors.errors.available_status[0]}}</span>
          </label>
          <div class="flex items-center mb-2">
            <input
              class="p-2 rounded border-2 w-full mr-4 flex-1"
              id="new_status"
              ref="new_status"
              type="text"
              :class="project.errors.errors.available_status ? 'border-red':''"
              v-model="new_status"
              @keyup.enter="addStatus"
            />
            <button class="btn btn-gray" @click="addStatus">Add Status</button>
          </div>
          <div v-if="project.available_status.length >0">
            <p class="text-sm">Drag and drop to control the order for the dropdowns and Kanban board</p>
            <ol>
              <!-- <draggable :list="project.available_status" group="default"> -->
              <li
                class="mb-1 flex items-center"
                v-for="(status, index) in project.available_status"
                :key="status[0]"
              >
                <span class="mr-2 w-4">{{index + 1}}.</span>
                <span
                  class="rounded py-1 px-2 bg-gray text-white mr-2 mb-2 w-32 flex items-center justify-between"
                >
                  <span class="rounded mr-2">{{status[0]}}</span>
                  <button class="h-3 w-3 fill-current" @click="removeStatus(index)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"
                      />
                    </svg>
                  </button>
                </span>
              </li>
              <!-- </draggable> -->
            </ol>
          </div>
        </div>
      </tab-panel>
    </tabs-nav>

    <div class="flex items-center justify-between">
      <button class="text-gray-600 underline" @click="reset">Cancel</button>
      <button
        class="text-white bg-blue px-4 py-2 rounded"
        @click="saveProject"
        v-if="editProject === undefined || Object.keys(editProject).length===0"
      >Save</button>
      <button class="text-white bg-blue px-4 py-2 rounded" @click="updateProject" v-else>Save</button>
    </div>
  </div>
</template>

<script>
import TabsNav from "../UI/Tabs/TabsNav";
import TabPanel from "../UI/Tabs/TabPanel";
import SelectInput from "../UI/SelectInput";
import DatePicker from "../UI/DatePicker";
import Form from "@johnlowery74/crucial-form";

export default {
  components: { TabsNav, TabPanel, SelectInput, DatePicker },
  props: ["editProject"],
  data() {
    return {
      project: new Form({
        title: "",
        description: "",
        status: "",
        start_date: "",
        due_date: "",
        priority: "",
        available_status: [
          ["Not Started", "Not Started"],
          ["In Progress", "In Progress"],
          ["Complete", "Complete"]
        ]
      }),
      new_status: ""
    };
  },
  methods: {
    reset() {
      this.project = {};
      this.$modal.hide(this.$parent.name);
    },
    saveProject() {
      this.$inertia.post("/projects", this.project);
      this.reset();
    },
    updateProject() {
      this.$inertia.patch(this.editProject.path, this.project);
      this.reset();
    },
    addStatus() {
      if (
        this.new_status &&
        !this.project.available_status.includes(this.new_status)
      ) {
        this.project.available_status.push([this.new_status, this.new_status]);
      }
      this.new_status = "";
      this.$refs.new_status.focus();
    },
    removeStatus(index) {
      this.project.available_status.splice(index, 1);
    }
  },
  created() {
    if (this.editProject) {
      this.project = { ...this.editProject };
    }
  }
};
</script>