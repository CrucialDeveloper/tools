 <template>
  <div class="flex flex-col p-4">
    <div class="flex items-center justify-between mb-4">
      <h3 class="mr-4 text-2xl" v-if="entry">Edit Work Entry</h3>
      <h3 class="mr-4 text-2xl" v-else>Create Work Entry</h3>
      <button
        class="ml-4 text-gray-500 underline hover:text-gray-700"
        @click.stop="cancelEdit"
      >Cancel</button>
    </div>
    <div class="my-auto mb-4">
      <div class="flex items-center mb-4">
        <label class="w-40 mr-4 font-bold text-right min-w-40" for="start_time">Start Time</label>
        <date-picker
          placeholder="Enter Start Time ..."
          class="w-full p-2 border rounded"
          :class="editedEntry.errors.has('start_time') ? 'border border-red-500': 'border'"
          :enableTime="true"
          v-model="editedEntry.start_time"
        ></date-picker>
      </div>
      <div class="flex items-center mb-4">
        <label class="w-40 mr-4 font-bold text-right min-w-40" for="end_time">End Time</label>
        <date-picker
          placeholder="Enter End Time ..."
          class="w-full p-2 border rounded"
          :class="editedEntry.errors.has('end_time') ? 'border border-red-500': 'border'"
          :enableTime="true"
          v-model="editedEntry.end_time"
        ></date-picker>
      </div>
      <div class="flex items-center mb-4">
        <label class="w-40 mr-4 font-bold text-right min-w-40" for="work_time">Actual Work Time</label>
        <input
          type="text"
          placeholder="Enter time worked in milliseconds or hh:mm:ss format ..."
          class="w-full p-2 border rounded"
          :class="editedEntry.errors.has('work_time') ? 'border border-red-500': 'border'"
          v-model="formattedWorkTime"
          @blur="setWorkTime($event)"
        />
      </div>
      <div class="flex items-center mb-4">
        <label class="w-40 mr-4 font-bold text-right min-w-40" for="work_type">Work Type</label>
        <select-input
          placeholder="Select Work Type ..."
          v-model="selectedWorkType"
          @input="changedWorkType($event)"
          :options="work_type_options"
          :class="editedEntry.errors.has('work_type') ? 'border border-red-500': 'border'"
        ></select-input>
      </div>
      <div class="flex items-start w-full mb-4">
        <label class="w-40 mr-4 font-bold text-right min-w-40" for="description">Description</label>
        <content-editor
          class="w-full"
          :class="editedEntry.errors.has('description') ? 'border border-red-500': 'border'"
          v-model="editedEntry.description"
          :default="editedEntry.description"
          toolbar="simple"
        ></content-editor>
      </div>
      <div class="flex items-center mb-4">
        <label class="w-40 mr-4 font-bold text-right min-w-40" for="billable">Billable</label>
        <select-input
          placeholder="Is this Billable?"
          v-model="editedEntry.billable"
          :options="[['Yes','Yes'],['No','No']]"
          :class="editedEntry.errors.has('billable') ? 'border border-red-500': 'border'"
        ></select-input>
      </div>
    </div>
    <div class="flex items-center justify-between w-full">
      <button
        class="text-red-500 underline hover:text-red-600"
        @click="deleteEntry"
        v-if="entry"
      >Delete</button>
      <button
        class="self-end p-2 mx-2 ml-auto text-white bg-blue-500 rounded hover:bg-blue-600"
        @click="saveEntry"
      >Save</button>
    </div>
  </div>
</template>

<script>
import ContentPaginator from "../Layouts/ContentPaginator";
import DatePicker from "../UI/DatePicker";
import SelectInput from "../UI/SelectInput";
import ContentEditor from "../UI/ContentEditor";
import WorkEntryModal from "./WorkEntryModal";
import Form from "@johnlowery74/crucial-form";

export default {
  name: "work-entry-modal",
  components: { ContentPaginator, DatePicker, SelectInput, ContentEditor },
  props: ["entry", "project"],
  data() {
    return {
      editedEntry: new Form({
        start_time: "",
        end_time: "",
        work_time: "",
        work_type: "",
        work_rate: "",
        description: "",
        billable: "",
        billed: ""
      }),
      editWorkTime: false,
      formattedWorkTime: "",
      selectedWorkType: ""
    };
  },
  methods: {
    setWorkTime(e) {
      this.convertToMilliseconds(e.target.value);
      if (!e.target.value.includes(":")) {
        this.formattedWorkTime = this.convertFromMilliseconds(e.target.value);
      }
    },
    convertToMilliseconds(time) {
      if (time.includes(":")) {
        this.editedEntry.work_time = this.timeToMs(time);
      } else {
        this.editedEntry.work_time = parseInt(time);
      }
    },
    convertFromMilliseconds(time) {
      return this.msToTime(time);
    },

    msToTime(time) {
      let milliseconds = parseInt((time % 1000) / 100);
      let seconds = Math.floor((time / 1000) % 60);
      let minutes = Math.floor((time / (1000 * 60)) % 60);
      let hours = Math.floor((time / (1000 * 60 * 60)) % 24);

      hours = hours < 10 ? "0" + hours : hours;
      minutes = minutes < 10 ? "0" + minutes : minutes;
      seconds = seconds < 10 ? "0" + seconds : seconds;

      return hours + ":" + minutes + ":" + seconds;
    },
    timeToMs(time) {
      let parts = time.split(":");
      return (
        parseInt(parts[0]) * 3600000 +
        parseInt(parts[1]) * 60000 +
        parseInt(parts[2]) * 1000
      );
    },
    titleCase(str) {
      str = str.split("_");
      str = str.map(item => {
        return item.charAt(0).toUpperCase() + item.slice(1);
      });
      str = str.join(" ");
      return str;
    },
    snake_case(str) {
      return str.toLowerCase().replace(" ", "_");
    },
    changedWorkType(e) {
      this.editedEntry.work_type = e.split("@")[0].trim();
      this.editedEntry.work_rate = e.substring(
        e.indexOf("$") + 1,
        e.indexOf("/")
      );
    },
    saveEntry() {
      if (this.entry) {
        this.editedEntry
          .patch(this.editedEntry.path, this.editedEntry)
          .then(response => {
            this.cancelEdit();
            this.$inertia.reload({
              method: "get"
            });
          })
          .catch(errors => {
            console.log(errors);
          });
      } else {
        this.editedEntry
          .post(this.project.path + "/workentry", this.editedEntry)
          .then(response => {
            this.cancelEdit();
            this.$inertia.reload({
              method: "get"
            });
          })
          .catch(errors => {
            console.log(errors);
          });
      }
    },
    cancelEdit() {
      this.editedItem = null;
      this.editedWorkTime = null;
      this.$modal.hide("work-entry-modal");
    },
    deleteEntry() {
      this.editedEntry
        .delete(this.editedEntry.path)
        .then(response => {
          this.$modal.hide("work-entry-modal");
          this.$inertia.reload({
            method: "get"
          });
        })
        .catch(errors => {
          console.log(errors);
        });
    }
  },
  computed: {
    work_type_options() {
      return this.project.work_type.map(type => {
        return this.titleCase(type[0]) + " @ $" + type[1] + "/hour";
      });
    }
  },
  mounted() {
    if (this.entry) {
      this.formattedWorkTime = this.convertFromMilliseconds(
        this.editedEntry.work_time
      );
    }
  },
  created() {
    if (this.entry) {
      this.editedEntry = new Form({ ...this.entry });
      this.selectedWorkType =
        this.titleCase(this.entry.work_type) +
        " @ $" +
        this.entry.work_rate +
        "/hour";
    }
  }
};
</script>