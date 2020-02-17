<template>
  <div class="min-h-full p-1 bg-gray-300 rounded">
    <div class="flex flex-col w-full min-h-full md:min-w-64 lg:flex-row">
      <div
        class="w-full min-h-full px-2 pt-2 pb-4 border-t border-l border-r border-gray-500 md:max-w-md"
        v-for="status in shown_status"
        :key="status"
      >
        <div class="font-bold text-center border-b">{{status}}</div>
        <div class="min-h-full pt-2">
          <draggable
            :list="byStatus(status)"
            group="default"
            @change="updateStatus($event, status)"
            animation="300"
            :sort="false"
          >
            <slot :item="card" v-for="card in byStatus(status)"></slot>
          </draggable>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Draggable from "vuedraggable";

export default {
  name: "KanbanBoard",
  components: { Draggable },
  props: ["items", "parent", "available_status"],
  data() {
    return {
      exclude_status: [],
      shown_status: []
    };
  },
  methods: {
    byStatus: function(status) {
      let vm = this;
      return _.orderBy(
        this.items.filter(function(item) {
          return item.status === status;
        }),
        "due_date",
        "asc"
      );
    },
    updateStatus: function(e, status) {
      if (Object.keys(e).includes("added")) {
        let item = this.items.filter(function(item) {
          return item.id === e.added.element.id;
        })[0];

        item.status = status;
        axios.patch(item.path, item);
      }
    }
  },
  created() {
    this.shown_status = this.available_status;
  }
};
</script>