<template>
  <div>
    <div class="md:min-w-64 w-full h-full flex flex-col lg:flex-row mt-4">
      <div
        class="w-full md:max-w-md border-gray-500 border-t border-l border-r p-2"
        v-for="status in shown_status"
        :key="status"
      >
        <div class="text-center font-bold border-b">{{status}}</div>
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
  mounted() {
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