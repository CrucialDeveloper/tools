<template>
  <div>
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
  </div>
</template>

<script>
import { Sortable, Plugins } from "@shopify/draggable";
export default {
  props: ["value"],
  data() {
    return {
      newItem: ""
    };
  },
  methods: {
    addItem() {
      if (this.newItem && !this.value.includes(this.newItem)) {
        this.value.push(this.newItem);
        this.newItem = "";
      }
    },
    removeItem(item) {
      this.value.splice(this.value.indexOf(item), 1);
    },
    emitNewOrder(e) {
      this.value = this.move(this.value, e.data.oldIndex, e.data.newIndex);
    },
    move(arr, from, to) {
      var element = arr[from];
      arr.splice(from, 1);
      arr.splice(to, 0, element);
      return arr;
    }
  },
  mounted() {
    const sortable = new Sortable(this.$refs.sortContainer, {
      draggable: "li",
      swapAnimation: {
        duration: 100,
        easingFunction: "ease-in-out"
      },
      plugins: [Plugins.SwapAnimation]
    });
    sortable.on("sortable:stop", e => this.emitNewOrder(e));
  }
};
</script>