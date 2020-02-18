<template>
  <div class="h-full pt-2 overflow-hidden">
    <div class="flex flex-wrap items-center w-full" v-if="filters">
      <span class="w-16 mr-2">Filters:</span>
      <button
        class="p-2 py-1 mr-4 border rounded hover:bg-blue-300 hover:text-white"
        :class="[activeFilters.includes(filter)?'bg-blue-500 text-white': '']"
        v-for="filter in filters"
        :key="filter"
        @click="setFilter(filter)"
      >{{filter}}</button>
    </div>
    <div>
      <div class="flex items-center w-full mt-4">
        <label class="w-16 mr-2" for>Search:</label>
        <div class="flex items-center w-full">
          <input type="text" class="p-1 border-t border-b border-l rounded-l w-72" v-model="search" />
          <button
            class="w-8 p-1 bg-gray-200 border-t border-b border-r rounded-r hover:bg-gray-300"
            @click="clearSearch"
          >X</button>
        </div>
      </div>
    </div>

    <div class="p-4 mt-4 bg-gray-100 rounded" v-if="filteredItems.length>0">
      <slot :items="filteredItems"></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContentFilter",
  props: {
    items: Array,
    searchable: Array,
    filters: Array,
    filterable: { default: true }
  },
  data() {
    return {
      search: "",
      searchCount: "",
      activeFilters: [],
      available_filters: []
    };
  },
  methods: {
    clearSearch() {
      this.search = "";
    },
    setFilter(filter) {
      if (this.activeFilters.includes(filter)) {
        this.activeFilters.splice(this.activeFilters.indexOf(filter), 1);
      } else {
        this.activeFilters.push(filter);
      }
    }
  },
  computed: {
    filteredItems: function() {
      if (!this.items) {
        return;
      }
      let vm = this;
      let results = [];
      if (vm.search) {
        results = vm.items.filter(function(item) {
          return vm.searchable.some(function(term) {
            if (term.includes(".")) {
              return eval(
                `item.${term}.toLowerCase().includes(vm.search.toLowerCase())`
              );
            } else {
              return item[term].toLowerCase().includes(vm.search.toLowerCase());
            }
          });
        });
      } else {
        results = this.items;
      }

      if (vm.activeFilters.length > 0) {
        results = results.filter(function(item) {
          return vm.activeFilters.includes(item.status);
        });
      }

      this.searchCount = results.length;
      return _.sortBy(results, ["title"]);
    }
  }
};
</script>