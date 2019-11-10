<template>
  <div>
    <div class="flex items-center justify-between mb-4 w-full">
      <div class="flex items-center w-full">
        <label>Items Per Page:</label>
        <select class="bg-white rounded border" name id v-model="paginator.perPage">
          <option value="5" selected>5</option>
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </div>
      <div class="w-full flex items-center justify-end" v-if="filterable">
        <label>Search:</label>
        <div class="rounded ml-2 flex items-center border rounded">
          <input type="text" class="p-1 w-full" v-model="search" />
          <button class="bg-gray-500 p-1 h-full" @click="clearSearch">x</button>
        </div>
      </div>
    </div>

    <div ref="table">
      <table class="text-sm w-full overflow-hidden relative">
        <tbody class="block overflow-y-scroll w-full" :style="{'height':bodyHeight}">
          <tr class="w-full">
            <th
              class="bg-gray-500 p-2 font-bold whitespace-no-wrap"
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
          <tr
            class="w-full border-b hover:bg-blue hover:text-white"
            v-for="item in filteredItems"
            :key="item.id"
            style="vertical-align:baseline;"
            @click="clicked(item)"
          >
            <td class="p-2" v-for="column in columns" :key="column">
              <span v-if="dateColumns.includes(column)" v-html="formatDate(item[column])"></span>
              <span v-else-if="linkColumn===column">
                <inertia-link
                  class="hover:underline"
                  :href="item[linkField] || item.link"
                  v-html="item[column]"
                  v-if="!fileLinks"
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

export default {
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
    }
  },
  computed: {
    beforePages: function() {
      let vm = this;
      return _.uniq([
        vm.paginator.currentPage - 3,
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
        vm.paginator.currentPage + 3,
        vm.paginator.totalPages - 3,
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
  },
  updated() {
    // this.bodyHeight = window.innerHeight - this.$el.offsetTop - 140 + "px";
    this.bodyHeight = window.innerHeight - 200 + "px";
  }
};
</script>