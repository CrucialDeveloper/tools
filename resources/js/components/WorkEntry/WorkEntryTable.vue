<template>
  <content-paginator :items="project.work_entries" v-slot:default="slotProps">
    <div ref="table" class="overflow-x-scroll">
      <table class="relative w-full overflow-hidden text-sm">
        <thead>
          <tr class="w-full">
            <th class="p-2 font-bold whitespace-no-wrap bg-gray-400"></th>
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
            :class="[editedItem === item ? 'bg-blue-100 hover:bg-blue-100':'']"
            v-for="item in slotProps.filteredItems"
            :key="item.id"
            style="vertical-align:top;"
          >
            <td class="p-2">
              <button class="w-5 h-5 text-gray-500" @click="editWorkEntry(item)">
                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                  <path
                    d="M6 34.5V42h7.5l22.13-22.13-7.5-7.5L6 34.5zm35.41-20.41c.78-.78.78-2.05 0-2.83l-4.67-4.67c-.78-.78-2.05-.78-2.83 0l-3.66 3.66 7.5 7.5 3.66-3.66z"
                  />
                </svg>
              </button>
            </td>
            <td class="p-2" v-html="item.start_time"></td>
            <td class="p-2" v-html="item.end_time"></td>
            <td class="p-2" v-html="convertFromMilliseconds(item.work_time)"></td>
            <td class="p-2" v-html="item.work_type"></td>
            <td class="p-2" v-html="item.description"></td>
            <td class="p-2" v-html="item.billable"></td>
            <td class="p-2" v-html="item.billed"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </content-paginator>
</template>

<script>
import ContentPaginator from "../Layouts/ContentPaginator";
import WorkEntryModal from "./WorkEntryModal";
import moment from "moment";

export default {
  components: { ContentPaginator, WorkEntryModal },
  props: ["project"],
  data() {
    return {
      editedItem: null,
      editWorkTime: null
    };
  },
  methods: {
    editWorkEntry(entry) {
      this.$modal.show(
        WorkEntryModal,
        { entry: entry, project: this.project },
        {
          name: "work-entry-modal",
          adaptive: true,
          height: "auto"
        }
      );
    },
    convertFromMilliseconds(time) {
      return moment
        .utc(moment.duration(time, "milliseconds").asMilliseconds())
        .format("HH:mm:ss");
    }
  }
};
</script>