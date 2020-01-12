<template>
  <div>
    <div class="flex items-center w-full min-w-full my-4">
      <div class="flex items-center flex-1">
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
            <svg
              class="w-4 h-4 fill-current"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
            >
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
    </div>

    <div ref="table">
      <table class="relative w-full overflow-hidden text-sm">
        <thead>
          <tr class="w-full">
            <th class="p-2 font-bold whitespace-no-wrap bg-gray-400">
              <span class="flex items-center">
                <span class="mr-4">Start Time</span>
                <span class="flex flex-col">
                  <button
                    class="w-4 h-4"
                    @click="sort('start_time', 'asc')"
                    :class="sortIndicator('start_time', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="sort('start_time', 'desc')"
                    :class="sortIndicator('start_time', 'desc')? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                      />
                    </svg>
                  </button>
                </span>
              </span>
            </th>

            <th class="p-2 font-bold whitespace-no-wrap bg-gray-400">
              <span class="flex items-center">
                <span class="mr-4">End Time</span>
                <span class="flex flex-col">
                  <button
                    class="w-4 h-4"
                    @click="sort('end_time', 'asc')"
                    :class="sortIndicator('end_time', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="sort('end_time', 'desc')"
                    :class="sortIndicator('end_time', 'desc')? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                      />
                    </svg>
                  </button>
                </span>
              </span>
            </th>

            <th class="p-2 font-bold whitespace-no-wrap bg-gray-400">
              <span class="flex items-center">
                <span class="mr-4">Work Time</span>
                <span class="flex flex-col">
                  <button
                    class="w-4 h-4"
                    @click="sort('work_time', 'asc')"
                    :class="sortIndicator('work_time', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="sort('work_time', 'desc')"
                    :class="sortIndicator('work_time', 'desc')? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                      />
                    </svg>
                  </button>
                </span>
              </span>
            </th>

            <th class="p-2 font-bold whitespace-no-wrap bg-gray-400">
              <span class="flex items-center">
                <span class="mr-4">Work Type</span>
                <span class="flex flex-col">
                  <button
                    class="w-4 h-4"
                    @click="sort('work_type', 'asc')"
                    :class="sortIndicator('work_type', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="sort('work_type', 'desc')"
                    :class="sortIndicator('work_type', 'desc')? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                      />
                    </svg>
                  </button>
                </span>
              </span>
            </th>

            <th class="p-2 font-bold whitespace-no-wrap bg-gray-400">
              <span class="flex items-center">
                <span class="mr-4">Description</span>
                <span class="flex flex-col">
                  <button
                    class="w-4 h-4"
                    @click="sort('description', 'asc')"
                    :class="sortIndicator('description', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="sort('description', 'desc')"
                    :class="sortIndicator('description', 'desc')? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                      />
                    </svg>
                  </button>
                </span>
              </span>
            </th>

            <th class="p-2 font-bold whitespace-no-wrap bg-gray-400">
              <span class="flex items-center">
                <span class="mr-4">Billable</span>
                <span class="flex flex-col">
                  <button
                    class="w-4 h-4"
                    @click="sort('billable', 'asc')"
                    :class="sortIndicator('billable', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="sort('billable', 'desc')"
                    :class="sortIndicator('billable', 'desc')? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                      />
                    </svg>
                  </button>
                </span>
              </span>
            </th>

            <th class="p-2 font-bold whitespace-no-wrap bg-gray-400">
              <span class="flex items-center">
                <span class="mr-4">Billed</span>
                <span class="flex flex-col">
                  <button
                    class="w-4 h-4"
                    @click="sort('billed', 'asc')"
                    :class="sortIndicator('billed', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="sort('billed', 'desc')"
                    :class="sortIndicator('billed', 'desc')? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                      />
                    </svg>
                  </button>
                </span>
              </span>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="w-full hover:bg-gray-200"
            v-for="item in filteredItems"
            :key="item.id"
            style="vertical-align:baseline;"
          >
            <td class="p-2" v-html="item.start_time"></td>
            <td class="p-2" v-html="item.end_time"></td>
            <td class="p-2" v-html="item.work_time"></td>
            <td class="p-2" v-html="item.work_type"></td>
            <td class="p-2" v-html="item.description"></td>
            <td class="p-2" v-html="item.billable"></td>
            <td class="p-2" v-html="item.billed"></td>
          </tr>
        </tbody>
      </table>
    </div>

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
import Vue from "vue";
import moment from "moment";

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