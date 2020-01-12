<template>
  <div class="w-full min-w-full">
    <div class="flex items-center flex-1 mb-4">
      <div class="relative inline-block w-24 mr-4 min-w-24">
        <select
          class="block w-full px-4 py-2 pr-8 leading-tight bg-white rounded shadow appearance-none focus:outline-none"
          v-model="paginator.perPage"
        >
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        <div
          class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none"
        >
          <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
          </svg>
        </div>
      </div>
      <div class="flex items-center w-full">
        <input
          class="w-full h-full p-2 leading-tight placeholder-gray-600 rounded-l shadow appearance-none focus:outline-none"
          type="text"
          placeholder="Search Projects ..."
          aria-label="search"
          v-model="search"
        />
        <button
          class="block p-2 leading-tight bg-gray-400 shadow fill-current round-r"
          type="button"
          @click="clearSearch"
        >x</button>
      </div>
    </div>
    <slot :filteredItems="filteredItems" :sort="sort" :sortIndicator="sortIndicator"></slot>

    <div ref="paginator" class="flex items-center mt-4" v-if="paginator.totalPages>1">
      <button
        class="p-1 mr-4 bg-gray-500 rounded"
        :disabled="paginator.currentPage===1"
        @click.prevent="paginator.currentPage=1"
      >First</button>

      <button
        class="p-1 mr-4 bg-gray-500 rounded min-w-10"
        v-for="page in beforePages"
        :key="page"
        @click.prevent="goToPage(page)"
      >{{page}}</button>

      <button
        class="px-2 py-1 mr-4 text-white bg-blue-500 rounded cursor-default min-w-10"
        disabled
      >{{paginator.currentPage}}</button>

      <button
        class="p-1 mr-4 bg-gray-500 rounded min-w-10"
        v-for="page in afterPages"
        :key="page"
        @click.prevent="goToPage(page)"
      >{{page}}</button>

      <button
        class="p-1 bg-gray-500 rounded"
        :disabled="paginator.currentPage===paginator.totalPages"
        @click.prevent="goToPage(paginator.totalPages)"
      >Last</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    items: Array
  },
  data() {
    return {
      search: "",
      paginator: {
        perPage: 10,
        currentPage: 1,
        totalPages: null
      },
      sortBy: {}
    };
  },
  watch: {
    "paginator.perPage": function() {
      this.paginator.currentPage = 1;
    },
    search: function() {
      this.paginator.currentPage = 1;
    }
  },
  methods: {
    clearSearch() {
      this.search = "";
    },
    goToPage(page) {
      this.paginator.currentPage = page;
    },
    sort: function(key, order) {
      if (key.includes(":")) {
        key = key.split(":")[1];
      }

      if (key in this.sortBy && this.sortBy[key] === order) {
        Vue.delete(this.sortBy, key);
      } else {
        Vue.set(this.sortBy, key, order);
      }
    },
    sortIndicator(column, direction) {
      if (column.includes(":")) {
        column = column.split(":")[1];
      }
      return (
        this.sortBy.hasOwnProperty(column) && this.sortBy[column] === direction
      );
    },
    clicked(item) {
      this.$emit("clickedItem", item);
    },
    openCreateProjectModal() {
      this.$modal.show(
        ProjectModal,
        {},
        {
          adaptive: true,
          height: "auto"
        }
      );
    }
  },
  computed: {
    beforePages: function() {
      let vm = this;
      return _.uniq([
        // vm.paginator.currentPage > 4 ? 1 : "",
        vm.paginator.currentPage > 5 ? 2 : "",
        vm.paginator.currentPage > 6 ? 3 : "",
        // vm.paginator.currentPage - 3,
        vm.paginator.currentPage - 2,
        vm.paginator.currentPage - 1
      ]).filter(function(page) {
        return page > 0 && page < vm.paginator.currentPage;
      });
    },
    afterPages: function() {
      let vm = this;

      return _.uniq([
        vm.paginator.currentPage + 1,
        vm.paginator.currentPage + 2,
        // vm.paginator.currentPage + 3,
        // vm.paginator.totalPages - 3,
        vm.paginator.totalPages - 2,
        vm.paginator.totalPages - 1
      ]).filter(function(page) {
        return (
          page > vm.paginator.currentPage &&
          page <= vm.paginator.totalPages &&
          !vm.beforePages.includes(page)
        );
      });
    },
    filteredItems: function() {
      let results = [];
      if (this.search) {
        results = this.items.filter(item => {
          return Object.keys(item).some(key => {
            return item[key]
              .toString()
              .toLowerCase()
              .includes(this.search.toString().toLowerCase());
          });
        });
      } else {
        results = this.items;
      }

      this.searchCount = results.length;
      this.paginator.totalPages = Math.ceil(
        results.length / this.paginator.perPage
      );

      let sorted = null;
      if (Object.keys(this.sortBy).length > 0) {
        sorted = _.orderBy(results, _.keys(this.sortBy), _.values(this.sortBy));
      } else {
        sorted = results;
      }

      sorted = _.chunk(sorted, this.paginator.perPage)[
        this.paginator.currentPage - 1
      ];

      return sorted;
    }
  }
};
</script>