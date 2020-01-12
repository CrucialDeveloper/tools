<template>
  <content-paginator :items="items" v-slot:default="slotProps">
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
                    @click="slotProps.sort('start_time', 'asc')"
                    :class="slotProps.sortIndicator('start_time', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="slotProps.sort('start_time', 'desc')"
                    :class="slotProps.sortIndicator('start_time', 'desc')? 'text-blue fill-current' : ''"
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
                    @click="slotProps.sort('end_time', 'asc')"
                    :class="slotProps.sortIndicator('end_time', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="slotProps.sort('end_time', 'desc')"
                    :class="slotProps.sortIndicator('end_time', 'desc')? 'text-blue fill-current' : ''"
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
                    @click="slotProps.sort('work_time', 'asc')"
                    :class="slotProps.sortIndicator('work_time', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="slotProps.sort('work_time', 'desc')"
                    :class="slotProps.sortIndicator('work_time', 'desc')? 'text-blue fill-current' : ''"
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
                    @click="slotProps.sort('work_type', 'asc')"
                    :class="slotProps.sortIndicator('work_type', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="slotProps.sort('work_type', 'desc')"
                    :class="slotProps.sortIndicator('work_type', 'desc')? 'text-blue fill-current' : ''"
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
                    @click="slotProps.sort('description', 'asc')"
                    :class="slotProps.sortIndicator('description', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="slotProps.sort('description', 'desc')"
                    :class="slotProps.sortIndicator('description', 'desc')? 'text-blue fill-current' : ''"
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
                    @click="slotProps.sort('billable', 'asc')"
                    :class="slotProps.sortIndicator('billable', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="slotProps.sort('billable', 'desc')"
                    :class="slotProps.sortIndicator('billable', 'desc')? 'text-blue fill-current' : ''"
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
                    @click="slotProps.sort('billed', 'asc')"
                    :class="slotProps.sortIndicator('billed', 'asc') ? 'text-blue fill-current' : ''"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path
                        d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"
                      />
                    </svg>
                  </button>
                  <button
                    class="w-4 h-4"
                    @click="slotProps.sort('billed', 'desc')"
                    :class="slotProps.sortIndicator('billed', 'desc')? 'text-blue fill-current' : ''"
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
            class="relative w-full hover:bg-gray-200"
            v-for="item in slotProps.filteredItems"
            :key="item.id"
            style="vertical-align:baseline;"
            @dblclick="editItem(item)"
          >
            <template v-if="editedItem != item">
              <td class="p-2" v-html="item.start_time"></td>
              <td class="p-2" v-html="item.end_time"></td>
              <td class="p-2" v-html="item.work_time"></td>
              <td class="p-2" v-html="item.work_type"></td>
              <td class="p-2" v-html="item.description"></td>
              <td class="p-2" v-html="item.billable"></td>
              <td class="p-2" v-html="item.billed"></td>
            </template>
            <template v-else>
              <td class="p-2">
                <date-picker v-model="editedItem.start_time"></date-picker>
              </td>
              <td class="p-2">Edit</td>
              <td class="p-2">Edit</td>
              <td class="p-2">Edit</td>
              <td class="p-2">Edit</td>
              <td class="p-2">Edit</td>
              <td class="p-2">Edit</td>
              <div class="fixed z-10 w-32 h-16 p-1 border-2 rounded">Edit Dialog</div>
            </template>
          </tr>
        </tbody>
      </table>
    </div>
  </content-paginator>
</template>

<script>
import ContentPaginator from "../Layouts/ContentPaginator";
import DatePicker from "../UI/DatePicker";

export default {
  components: { ContentPaginator, DatePicker },
  props: ["items"],
  data() {
    return {
      editedItem: null
    };
  },
  methods: {
    editItem(item) {
      this.editedItem = item;
    }
  }
};
</script>