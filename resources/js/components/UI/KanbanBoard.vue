<template>
  <div class="h-full bg-gray-200">
    <div class="flex flex-col w-full h-full md:min-w-64 lg:flex-row">
      <div
        class="w-full p-2 border-t border-l border-r border-gray-500 md:max-w-md"
        v-for="status in shown_status"
        :key="status"
      >
        <div class="font-bold text-center border-b">{{status}}</div>
        <div class="pt-2">
          <draggable
            :list="byStatus(status)"
            group="default"
            @change="updateStatus($event, status)"
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
  props: ["items", "parent"],
  data() {
    return {
      available_status: [],
      exclude_status: [],
      shown_status: [
        "New",
        "Not Started",
        "In Progress",
        "On Hold",
        "Completed"
      ]
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
    this.available_status = _.uniq(
      this.items
        .map(item => {
          return item.status;
        })
        .sort()
    );

    this.available_status.forEach(status => {
      if (!this.shown_status.includes(status)) {
        this.shown_status.unshift(status);
      }
    });
  }
};
</script>