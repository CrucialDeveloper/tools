<template>
  <div>
    <ul ref="sortContainer" class="focus:outline-none">
      <li
        class="w-48 px-2 py-1 mt-2 bg-gray-500 rounded hover:bg-gray-600"
        v-for="item in value"
        :key="item"
      >{{item}}</li>
    </ul>
  </div>
</template>

<script>
import { Sortable, Plugins } from "@shopify/draggable";
export default {
  props: ["value"],
  methods: {
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