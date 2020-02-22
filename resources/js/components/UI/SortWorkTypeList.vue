<template>
  <div>
    <div class="flex items-center justify-between mb-4">
      <label for="new_work_type" class="w-64 mr-2 text-right">Work Type Name:</label>
      <input
        class="flex-1 w-full p-2 border rounded"
        id="new_work_type"
        ref="new_work_type"
        type="text"
        v-model="new_work_type"
      />
    </div>
    <div class="flex items-center mt-4">
      <label for="new_status" class="w-64 mr-2 text-right">Work Type Rate (in dollars/hour):</label>
      <input
        class="flex-1 w-full p-2 border rounded"
        id="new_work_rate"
        ref="new_work_rate"
        type="text"
        v-model="new_work_rate"
      />
    </div>
    <div class="flex items-center justify-end w-full mt-4 text-right">
      <p
        class="mr-4 text-red-500"
        v-if="alreadyExists"
      >This combination of type and rate already exists.</p>
      <button
        class="p-2 bg-gray-200 border rounded hover:bg-gray-300 hover:bg-gray"
        @click="addWorkType()"
      >Add Work Type</button>
    </div>
    <p>Drag and Drop to reorder the items in the list.</p>
    <div class="w-80">
      <ol ref="sortContainer" class="focus:outline-none" tabindex="-1">
        <li v-for="item in value" :key="item[0]+item[1]">
          <div
            class="flex items-center justify-between px-2 py-1 mt-2 bg-gray-200 rounded hover:bg-gray-300"
          >
            <span class="mr-4">{{titleCase(item[0])}} @ ${{item[1]}}/Per Hour</span>
            <button @click="removeWorkType(item)">X</button>
          </div>
        </li>
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
      new_work_type: "",
      new_work_rate: "",
      alreadyExists: false
    };
  },
  methods: {
    addWorkType() {
      if (this.workTypeNew()) {
        this.value.push([
          this.snake_case(this.new_work_type),
          this.new_work_rate
        ]);
        this.new_work_rate = "";
        this.new_work_type = "";
        this.alreadyExists = false;
      } else {
        this.alreadyExists = true;
      }
    },
    removeWorkType(item) {
      this.value.splice(this.value.indexOf(item), 1);
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
    setNewOrder(e) {
      this.value = this.move(this.value, e.data.oldIndex, e.data.newIndex);
    },
    move(arr, from, to) {
      var element = arr[from];
      arr.splice(from, 1);
      arr.splice(to, 0, element);
      return arr;
    },
    workTypeNew() {
      return (
        this.new_work_type &&
        this.new_work_rate &&
        !this.value.some(item => {
          return (
            this.snake_case(item[0]) == this.snake_case(this.new_work_type) &&
            item[1] == this.new_work_rate
          );
        })
      );
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
    sortable.on("sortable:stop", e => this.setNewOrder(e));
  },
  created() {
    this.work_types = this.value;
  }
};
</script>