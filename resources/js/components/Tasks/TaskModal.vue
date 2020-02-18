<template>
  <div class="flex flex-col h-full p-4 overflow-x-hidden">
    <h3
      class="mb-4 text-2xl"
    >{{(editTask === undefined || Object.keys(editTask).length ===0)? 'New Task' : 'Edit Task'}}</h3>
    <div class="mb-4 overflow-y-scroll">
      <label for="name" class="block font-bold">
        Title:
        <span
          class="ml-2 text-sm font-normal text-red"
          v-if="task.errors.errors.title"
        >{{task.errors.errors.title[0]}}</span>
      </label>
      <input
        class="w-full p-2 border rounded"
        id="name"
        type="text"
        :class="task.errors.errors.title ? 'border-red':''"
        v-model="task.title"
      />
    </div>
    <div class="mb-4">
      <label for="description" class="block font-bold">
        Description:
        <span
          class="ml-2 text-sm font-normal text-red"
          v-if="task.errors.errors.description"
        >{{task.errors.errors.description[0]}}</span>
      </label>
      <content-editor v-model="task.description" :default="task.description"></content-editor>
    </div>
    <div class="flex flex-col md:flex-row md:items-center">
      <div class="w-full mr-8 md:w-1/2">
        <div class="w-full mb-4">
          <label for="status" class="flex-shrink-0 mr-2 font-bold">
            Status:
            <span
              class="ml-2 text-sm font-normal text-red"
              v-if="task.errors.errors.status"
            >{{task.errors.errors.status[0]}}</span>
          </label>
          <select-input
            :options="project.task_status_options"
            placeholder="Select Status ..."
            v-model="task.status"
            :class="task.errors.errors.status ? 'border-red border rounded':''"
          ></select-input>
        </div>
      </div>
      <div class="w-full md:w-1/2">
        <div class="mb-4">
          <label for="status" class="flex-shrink-0 mr-2 font-bold">
            Priority:
            <span
              class="ml-2 text-sm font-normal text-red"
              v-if="task.errors.errors.priority"
            >{{task.errors.errors.priority[0]}}</span>
          </label>
          <select-input
            :options="['P1','P2','P3']"
            placeholder="Select Priority ..."
            v-model="task.priority"
            :class="task.errors.errors.priority ? 'border-red border rounded':''"
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
            v-if="task.errors.errors.start_date"
          >{{task.errors.errors.start_date[0]}}</span>
        </label>
        <div>
          <date-picker
            class="p-2"
            :class="task.errors.errors.start_date ? 'border-red border rounded':'border rounded w-full'"
            v-model="task.start_date"
          ></date-picker>
        </div>
      </div>
      <div class="w-full mb-4 md:w-1/2">
        <label for="due_date" class="flex-shrink-0 mr-2 font-bold">
          Due Date:
          <span
            class="ml-2 text-sm font-normal text-red"
            v-if="task.errors.errors.due_date"
          >{{task.errors.errors.due_date[0]}}</span>
        </label>
        <div>
          <date-picker
            class="p-2"
            :class="task.errors.errors.due_date ? 'border-red border rounded':'border rounded w-full'"
            v-model="task.due_date"
          ></date-picker>
        </div>
      </div>
    </div>
    <div class="flex items-center justify-between mt-auto">
      <button class="mr-4 text-red-500 underline" @click="deleteTask">Delete</button>
      <div class="flex items-center justify-end w-full">
        <button class="mr-4 text-gray-600 underline" @click="reset">Cancel</button>
        <button
          class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
          @click="saveTask"
          v-if="editTask === undefined || Object.keys(editTask).length===0"
        >Save</button>
        <button
          class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
          @click="updateTask"
          v-else
        >Save</button>
      </div>
    </div>
  </div>
</template>

<script>
import SelectInput from "../UI/SelectInput";
import DatePicker from "../UI/DatePicker";
import ContentEditor from "../UI/ContentEditor";
import Form from "@johnlowery74/crucial-form";

export default {
  components: {
    SelectInput,
    DatePicker,
    ContentEditor
  },
  props: ["project", "editTask"],
  data() {
    return {
      task: new Form({
        title: "",
        description: "",
        status: "",
        start_date: "",
        due_date: "",
        priority: ""
      })
    };
  },
  methods: {
    reset() {
      this.task = new Form({});
      this.$modal.hide(this.$parent.name);
    },
    saveTask() {
      this.task
        .post(this.project.path + "/tasks", this.task)
        .then(response => {
          this.$inertia.visit(response);
          this.reset();
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    updateTask() {
      this.task
        .patch(this.task.path, this.task)
        .then(response => {
          this.$inertia.visit(response);
          this.reset();
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    deleteTask() {
      this.task
        .delete(this.task.path)
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
    if (this.editTask) {
      this.task = new Form({ ...this.editTask });
    }
  }
};
</script>