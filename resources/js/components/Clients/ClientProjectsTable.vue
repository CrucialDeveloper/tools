<template>
  <div>
    <div class="mb-4 flex items-center w-full">
      <div class="flex items-center flex-1">
        <div class="inline-block relative min-w-24 w-24 mr-4">
          <select
            class="block appearance-none w-full bg-white px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none"
            v-model="paginator.perPage"
          >
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <div
            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
          >
            <svg
              class="fill-current h-4 w-4"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
            >
              <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
            </svg>
          </div>
        </div>
        <div class="flex items-center w-full mr-4">
          <input
            class="appearance-none h-full w-full p-2 rounded-l leading-tight focus:outline-none shadow"
            type="text"
            placeholder="Search Projects ..."
            aria-label="search"
            v-model="search"
          />
          <button
            class="block p-2 round-r shadow bg-gray-400 leading-tight fill-current"
            type="button"
            @click="clearSearch"
          >x</button>
        </div>
      </div>
      <button
        class="w-8 h-8 flex items-center justify-center bg-blue rounded-full text-white leading-none p-2 fill-current shadow"
        @click="openCreateProjectModal"
      >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 16">
          <path d="M4 7V4H3v3H0v1h3v3h1V8h3V7H4z" />
        </svg>
      </button>
    </div>

    <div ref="table">
      <table class="text-sm w-full overflow-hidden relative">
        <thead>
          <tr class="w-full">
            <th
              class="bg-gray-400 p-2 font-bold whitespace-no-wrap"
              v-for="column in columns"
              :key="column"
            >
              <span class="flex items-center">
                <span class="mr-4">{{toTitleCase(column)}}</span>
                <span class="flex flex-col" v-if="sortColumns.includes(column)">
                  <button
                    class="h-4 w-4"
                    @click="sort(column, 'asc')"
                    :class="sortBy.hasOwnProperty(column) && sortBy[column]==='asc' ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="h-4 w-4"
                    @click="sort(column, 'desc')"
                    :class="sortBy.hasOwnProperty(column) && sortBy[column]==='desc' ? 'text-blue fill-current' : ''"
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
            <td class="p-2" v-for="column in columns" :key="column">
              <span v-if="dateColumns.includes(column)" v-html="formatDate(item[column])"></span>
              <span v-else-if="linkColumn===column">
                <inertia-link
                  class="hover:underline"
                  preserve-state
                  :href="item[linkField] || item.link"
                  v-html="item[column]"
                  v-if="!fileLinks"
                  preset
                ></inertia-link>
                <a
                  class="hover:underline"
                  :href="item[linkField] || item.link"
                  v-html="item[column]"
                  v-if="fileLinks"
                  download
                ></a>
              </span>
              <span v-else v-html="item[column]"></span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div ref="paginator" class="mt-4 flex items-center" v-if="paginator.totalPages>1">
      <button
        class="bg-gray-500 p-1 rounded mr-4"
        :disabled="paginator.currentPage===1"
        @click.prevent="paginator.currentPage=1"
      >First</button>

      <button
        class="bg-gray-500 p-1 rounded mr-4 min-w-10"
        v-for="page in beforePages"
        :key="page"
        @click.prevent="goToPage(page)"
      >{{page}}</button>

      <button
        class="bg-blue-500 text-white py-1 px-2 rounded mr-4 cursor-default min-w-10"
        disabled
      >{{paginator.currentPage}}</button>

      <button
        class="bg-gray-500 p-1 rounded mr-4 min-w-10"
        v-for="page in afterPages"
        :key="page"
        @click.prevent="goToPage(page)"
      >{{page}}</button>

      <button
        class="bg-gray-500 p-1 rounded"
        :disabled="paginator.currentPage===paginator.totalPages"
        @click.prevent="goToPage(paginator.totalPages)"
      >Last</button>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import { format } from "date-fns";
import ProjectModal from "./ProjectModal";

export default {
  components: { ProjectModal },
  props: {
    items: Array,
    columns: Array,
    dateColumns: {
      default: function() {
        return [];
      }
    },
    searchable: Array,
    sortable: Array,
    filterable: {
      default: true
    },
    linkColumn: String,
    linkField: String,
    fileLinks: Boolean
  },
  data() {
    return {
      search: "",
      searchCount: "",
      paginator: {
        perPage: 25,
        currentPage: 1,
        totalPages: null
      },
      sortBy: {},
      bodyHeight: "0px"
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
    toTitleCase(str) {
      return str
        .split("_")
        .map(w => w[0].toUpperCase() + w.substr(1).toLowerCase())
        .join(" ");
    },
    formatDate(date) {
      return `${dateFns.format(date, "MM/DD/YYYY")}`;
    },
    sort: function(key, order) {
      if (key in this.sortBy && this.sortBy[key] === order) {
        Vue.delete(this.sortBy, key);
      } else {
        Vue.set(this.sortBy, key, order);
      }
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
      if (!this.items) {
        return;
      }
      let vm = this;
      let results = [];
      if (vm.search) {
        results = vm.items.filter(function(item) {
          return vm.searchColumns.some(function(term) {
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

      this.searchCount = results.length;
      this.paginator.totalPages = Math.ceil(
        results.length / this.paginator.perPage
      );

      let sorted = null;
      if (Object.keys(this.sortBy).length > 0) {
        sorted = _.orderBy(results, _.keys(vm.sortBy), _.values(vm.sortBy));
      } else {
        sorted = results;
      }

      sorted = _.chunk(sorted, this.paginator.perPage)[
        this.paginator.currentPage - 1
      ];

      return sorted;
    },
    searchColumns() {
      return this.searchable || this.columns;
    },
    sortColumns() {
      return this.sortable || this.columns;
    }
  }
};
</script>