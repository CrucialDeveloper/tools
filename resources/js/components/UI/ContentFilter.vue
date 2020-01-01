<template>
  <div>
    <div class="flex items-center w-full mt-4">
      <div class="w-full flex flex-col" v-if="filters">
        <div class="flex items-center mx-2 mb-4 flex-wrap w-full md:w-auto">
          <span class="mr-2">Filters:</span>
          <button
            class="btn shadow-none border mr-4 hover:bg-gray-500 text-sm md:text-base p-1 rounded"
            :class="[activeFilters.includes(filter)?'bg-gray': '']"
            v-for="filter in available_filters"
            :key="filter"
            @click="setFilter(filter)"
          >{{filter}}</button>
        </div>
        <div class="flex items-center self-start w-full mb-4">
          <label for>Search:</label>
          <div class="rounded ml-2 flex items-center border rounded w-full md:w-3/5">
            <input type="text" class="p-1 w-full" v-model="search" />
            <button class="bg-gray-500 p-1 h-full w-10 shadow" @click="clearSearch">x</button>
          </div>
        </div>
      </div>
    </div>

    <slot :items="filteredItems"></slot>
  </div>
</template>

<script>
export default {
  name: "ContentFilter",
  props: {
    items: Array,
    searchable: Array,
    filters: Boolean,
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
  },
  mounted() {
    this.available_filters = _.uniq(
      this.items
        .map(item => {
          return item.status;
        })
        .sort()
    );
  }
};
</script>