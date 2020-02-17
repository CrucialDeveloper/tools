<template>
  <div>
    <div class="flex items-center w-full">
      <div class="flex items-center justify-between flex-1 border-t border-b border-l rounded-l">
        <input type="text" class="w-full p-2" v-model="newItem" @keydown.enter="addItem()" />
        <button class="px-2 py-1 text-gray-500" @click="newItem = ''">X</button>
      </div>
      <button class="p-2 bg-gray-500 rounded-r hover:bg-gray-600" @click="addItem()">Add Status</button>
    </div>

    <ul ref="sortContainer" class="focus:outline-none" tabindex="-1">
      <li
        class="flex items-center justify-between w-56 px-2 py-1 mt-2 bg-gray-500 rounded select-none hover:bg-gray-600"
        v-for="item in value"
        :key="item"
      >
        <span class="mr-4">{{item}}</span>
        <button class="px-2" @click="removeItem(item)">X</button>
      </li>
    </ul>
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

<style scoped>
.draggable-source--is-dragging {
  opacity: 0.5;
}

.draggable-mirror {
  display: none;
}
</style>