<template>
  <div>
    <div>
      <div class="flex items-center w-full">
        <input type="text" class="p-1 border-t border-b border-l rounded-l w-72" v-model="search" />
        <button
          class="w-8 p-1 bg-gray-200 border-t border-b border-r rounded-r hover:bg-gray-300"
          @click="search = ''"
        >X</button>
      </div>
    </div>
    <div class="min-h-full p-1 my-4 bg-gray-100 rounded">
      <div class="flex flex-col w-full min-h-full md:min-w-64 lg:flex-row">
        <div
          class="w-full min-h-full px-2 pt-2 pb-4 border-t border-l border-r border-gray-200 md:max-w-md"
          v-for="status in shown_status"
          :key="status"
        >
          <div class="font-bold text-center border-b border-gray-200">{{status}}</div>
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
  </div>
</template>

<script>
import Draggable from "vuedraggable";

export default {
  name: "KanbanBoard",
  components: { Draggable },
  props: ["items", "parent", "available_status", "placeholder"],
  data() {
    return {
      exclude_status: [],
      shown_status: [],
      search: ""
    };
  },
  methods: {
    byStatus: function(status) {
      let vm = this;
      return _.orderBy(
        this.items.filter(item => {
          if (this.search) {
            return (
              item.status === status &&
              item.title
                .toLowerCase()
                .includes(
                  this.search.toLowerCase() ||
                    item
                      .descriptiontoLowerCase()
                      .includes(this.search.toLowerCase())
                )
            );
          } else {
            return item.status === status;
          }
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