<template>
  <div>
    <div class="mb-4">
      <button
        class="w-full p-2 text-white bg-blue-500 rounded"
        @click="openWorkEntryModal"
      >Create Manual Entry</button>
      <div class="w-full my-4 font-bold text-center">OR</div>
    </div>
    <div class="w-56 mx-auto">
      <div class="font-mono text-2xl text-center text-gray-700">{{timer}}</div>
      <div class="flex items-center justify-between mt-2">
        <!-- play -->
        <button
          class="w-6 h-6 text-gray-200 fill-current"
          :class="[mode==='running' || entry.work_time>0 ? 'cursor-not-allowed': '']"
          :disabled="mode==='running' || entry.work_time>0"
          @click="start"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <path d="M16 10v28l22-14z" />
            <path d="M0 0h48v48H0z" fill="none" />
          </svg>
        </button>

        <!-- pause -->
        <button
          class="w-6 h-6 text-gray-200 fill-current"
          :class="[mode==='stopped' ? 'cursor-not-allowed': '']"
          :disabled="mode==='stopped'"
          @click="pause"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <path d="M12 38h8V10h-8v28zm16-28v28h8V10h-8z" />
          </svg>
        </button>

        <!-- stop -->
        <button
          class="w-6 h-6 text-gray-200 fill-current"
          :class="[(mode==='paused' || mode==='stopped') ? 'cursor-not-allowed': '']"
          :disabled="mode==='paused'"
          @click="stop"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <path d="M12 12h24v24H12z" />
          </svg>
        </button>

        <!-- refresh -->
        <button class="w-6 h-6 text-gray-200 fill-current" @click="refresh">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <path
              d="M35.3 12.7C32.41 9.8 28.42 8 24 8 15.16 8 8.02 15.16 8.02 24S15.16 40 24 40c7.45 0 13.69-5.1 15.46-12H35.3c-1.65 4.66-6.07 8-11.3 8-6.63 0-12-5.37-12-12s5.37-12 12-12c3.31 0 6.28 1.38 8.45 3.55L26 22h14V8l-4.7 4.7z"
            />
          </svg>
        </button>
      </div>
    </div>
    <div class="mt-4" v-if="mode==='stopped'">
      <div class="flex items-center justify-between">
        <select-input
          class="mb-4 mr-4"
          v-model="entry.work_type"
          :options="project.work_type"
          placeholder="Select Work Type ..."
        ></select-input>
        <div class="flex items-center">
          <input
            id="billable"
            type="checkbox"
            class="p-2 mr-2"
            v-model="entry.billable"
            true-value="Yes"
            false-value="No"
            :checked="entry.billable==='Yes'"
          />
          <label for="billable">Billable</label>
        </div>
      </div>
      <content-editor v-model="entry.description"></content-editor>
      <button
        class="w-full p-2 mt-4 bg-gray-200 rounded fill-current hover:bg-gray-600"
        :class="[mode != 'stopped' || entry.work_time === 0 ? 'cursor-not-allowed': '']"
        :disabled="mode !='stopped' ||entry.work_time ===0"
        @click="save"
      >Save</button>
    </div>
  </div>
</template>

<script>
import ContentEditor from "../UI/ContentEditor";
import SelectInput from "../UI/SelectInput";
import WorkEntryModal from "../WorkEntry/WorkEntryModal";
import Form from "@johnlowery74/crucial-form";

export default {
  components: { ContentEditor, SelectInput, Form },
  props: ["project"],
  data() {
    return {
      mode: "new",
      time: "",
      timerTime: null,
      pausedTime: null,
      entry: new Form({
        start_time: null,
        end_time: null,
        work_time: 0,
        work_type: "",
        description: "",
        billable: "Yes"
      })
    };
  },
  methods: {
    start() {
      if (this.mode === "stopped" || this.mode === "new") {
        this.entry.start_time = Date.now();
        this.timerTime = this.entry.start_time;
        this.mode = "running";
        this.stopWatch = setInterval(() => {
          this.entry.work_time = Date.now() - this.timerTime;
        }, 10);
      }
      if (this.mode === "paused") {
        this.unpause();
      }
    },
    pause() {
      if (this.mode === "paused") {
        this.unpause();
      } else {
        this.mode = "paused";
        this.pausedTime = Date.now();
        clearInterval(this.stopWatch);
      }
    },
    unpause() {
      this.mode = "running";
      this.timerTime = this.timerTime - (this.pausedTime - Date.now());
      this.stopWatch = setInterval(() => {
        this.entry.work_time = Date.now() - this.timerTime;
      }, 10);
    },
    stop() {
      this.mode = "stopped";
      this.entry.end_time = Date.now();
      clearInterval(this.stopWatch);
    },
    refresh() {
      this.mode = "new";
      this.time = "";
      this.timerTime = null;
      this.pausedTime = null;
      this.entry.start_time = null;
      this.entry.end_time = null;
      this.entry.work_time = 0;
      this.entry.work_type = "";
      this.entry.description = "";
      this.entry.billable = "Yes";
      clearInterval(this.stopWatch);
    },
    openWorkEntryModal() {
      this.$modal.show(
        WorkEntryModal,
        { project: this.project },
        {
          name: "work-entry-modal",
          adaptive: true,
          height: "auto"
        }
      );
    },
    save() {
      this.entry
        .post(this.project.path + "/workentry", this.entry)
        .then(response => {
          this.refresh();
          this.$inertia.reload();
        })
        .catch(errors => console.log(errors));
    }
  },
  computed: {
    timer() {
      let milliseconds = parseInt((this.entry.work_time % 1000) / 10);
      let seconds = Math.floor((this.entry.work_time / 1000) % 60);
      let minutes = Math.floor((this.entry.work_time / (1000 * 60)) % 60);
      let hours = Math.floor((this.entry.work_time / (1000 * 60 * 60)) % 24);
      hours = hours < 10 ? "0" + hours : hours;
      minutes = minutes < 10 ? "0" + minutes : minutes;
      seconds = seconds < 10 ? "0" + seconds : seconds;
      milliseconds = milliseconds < 10 ? "0" + milliseconds : milliseconds;

      this.time = hours + ":" + minutes + ":" + seconds + "." + milliseconds;
      return hours + ":" + minutes + ":" + seconds + "." + milliseconds;
    }
  }
};
</script>