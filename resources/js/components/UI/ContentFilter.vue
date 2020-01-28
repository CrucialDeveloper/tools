<template>
  <div class="overflow-hidden h-ful">
    <div class="flex items-center w-full mt-4">
      <div class="flex flex-col w-full" v-if="filters">
        <div class="flex flex-wrap items-center w-full mx-2 mb-4 md:w-auto">
          <span class="mr-2">Filters:</span>
          <button
            class="p-1 mr-4 text-sm border rounded shadow-none btn hover:bg-gray-500 md:text-base"
            :class="[activeFilters.includes(filter)?'bg-gray': '']"
            v-for="filter in available_filters"
            :key="filter"
            @click="setFilter(filter)"
          >{{filter}}</button>
        </div>
        <div class="flex items-center self-start w-full mb-4">
          <label for>Search:</label>
          <div class="flex items-center w-full ml-2 border rounded md:w-3/5">
            <input type="text" class="w-full p-1" v-model="search" />
            <button class="w-10 h-full p-1 bg-gray-500 shadow" @click="clearSearch">x</button>
          </div>
        </div>
      </div>
    </div>

    <div class="p-4 bg-gray-200 rounded" v-if="filteredItems.length>0">
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