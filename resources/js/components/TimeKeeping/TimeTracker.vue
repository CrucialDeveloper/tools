<template>
  <div>
    <div class="w-56 mx-auto">
      <div class="text-center text-2xl font-mono text-gray-700">{{timer}}</div>
      <div class="flex items-center justify-between mt-2">
        <!-- play -->
        <button
          class="w-6 h-6 text-gray-500 fill-current"
          :class="[mode==='running' || elapsedTime>0 ? 'cursor-not-allowed': '']"
          :disabled="mode==='running' || elapsedTime>0"
          @click="start"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <path d="M16 10v28l22-14z" />
            <path d="M0 0h48v48H0z" fill="none" />
          </svg>
        </button>

        <!-- pause -->
        <button
          class="w-6 h-6 text-gray-500 fill-current"
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
          class="w-6 h-6 text-gray-500 fill-current"
          :class="[(mode==='paused' || mode==='stopped') ? 'cursor-not-allowed': '']"
          :disabled="mode==='paused'"
          @click="stop"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <path d="M12 12h24v24H12z" />
          </svg>
        </button>

        <!-- refresh -->
        <button class="w-6 h-6 text-gray-500 fill-current" @click="refresh">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <path
              d="M35.3 12.7C32.41 9.8 28.42 8 24 8 15.16 8 8.02 15.16 8.02 24S15.16 40 24 40c7.45 0 13.69-5.1 15.46-12H35.3c-1.65 4.66-6.07 8-11.3 8-6.63 0-12-5.37-12-12s5.37-12 12-12c3.31 0 6.28 1.38 8.45 3.55L26 22h14V8l-4.7 4.7z"
            />
          </svg>
        </button>
      </div>
    </div>
    <div class="mt-4">
      <select-input class="mb-4" v-model="work_type"></select-input>
      <content-editor v-model="description"></content-editor>
    </div>
    <!-- save -->
    <!-- <button
        class="w-6 h-6 text-gray-500 fill-current"
        :class="[mode != 'stopped' || elapsedTime === 0 ? 'cursor-not-allowed': '']"
        :disabled="mode !='stopped' ||elapsedTime ===0"
        @click="save"
      >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
          <path
            d="M34 6H10c-2.21 0-4 1.79-4 4v28c0 2.21 1.79 4 4 4h28c2.21 0 4-1.79 4-4V14l-8-8zM24 38c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm6-20H10v-8h20v8z"
          />
        </svg>
    </button>-->
  </div>
</template>

<script>
import ContentEditor from "../UI/ContentEditor";
import SelectInput from "../UI/SelectInput";

export default {
  components: { ContentEditor, SelectInput },
  data() {
    return {
      mode: "stopped",
      time: "",
      timerTime: null,
      startTime: null,
      pausedTime: null,
      endTime: null,
      elapsedTime: 0,
      work_type: "",
      description: ""
    };
  },
  methods: {
    start() {
      if (this.mode === "stopped") {
        this.startTime = Date.now();
        this.timerTime = this.startTime;
        this.mode = "running";
        this.stopWatch = setInterval(() => {
          this.elapsedTime = Date.now() - this.timerTime;
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
        this.elapsedTime = Date.now() - this.timerTime;
      }, 10);
    },
    stop() {
      this.mode = "stopped";
      this.endTime = Date.now();
      clearInterval(this.stopWatch);
    },
    refresh() {
      this.mode = "stopped";
      this.time = "";
      this.timerTime = null;
      this.startTime = null;
      this.pausedTime = null;
      this.endTime = null;
      this.elapsedTime = 0;
      (this.type = ""), (this.description = "");
      clearInterval(this.stopWatch);
    },
    save() {
      this.$emit("recordTime", {
        start: this.startTime,
        end: this.endTime,
        elapsed: this.elapsedTime,
        type: this.time,
        description: this.description
      });
      this.refresh();
    }
  },
  computed: {
    timer() {
      let milliseconds = parseInt((this.elapsedTime % 1000) / 10);
      let seconds = Math.floor((this.elapsedTime / 1000) % 60);
      let minutes = Math.floor((this.elapsedTime / (1000 * 60)) % 60);
      let hours = Math.floor((this.elapsedTime / (1000 * 60 * 60)) % 24);
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