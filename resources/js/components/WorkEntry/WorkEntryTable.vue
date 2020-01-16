<template>
  <content-paginator :items="project.work_entries" v-slot:default="slotProps">
    <div ref="table" class="overflow-x-scroll">
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
            :class="[editedItem === item ? 'bg-blue-100 hover:bg-blue-100':'']"
            v-for="item in slotProps.filteredItems"
            :key="item.id"
            style="vertical-align:top;"
            @click="editItem(item)"
          >
            <template v-if="editedItem===null">
              <td class="p-2" v-html="item.start_time"></td>
              <td class="p-2" v-html="item.end_time"></td>
              <td class="p-2" v-html="convertFromMilliseconds(item.work_time)"></td>
              <td class="p-2" v-html="item.work_type"></td>
              <td class="p-2" v-html="item.description"></td>
              <td class="p-2" v-html="item.billable"></td>
              <td class="p-2" v-html="item.billed"></td>
            </template>
            <template v-else class="flex items-start">
              <td class="p-2">
                <date-picker
                  class="p-2 border rounded"
                  :enableTime="true"
                  v-model="editedItem.start_time"
                ></date-picker>
              </td>
              <td class="p-2">
                <date-picker
                  class="p-2 border rounded"
                  :enableTime="true"
                  v-model="editedItem.end_time"
                ></date-picker>
              </td>
              <td class="p-2">
                <input
                  type="text"
                  class="p-2 border rounded"
                  v-model="editWorkTime"
                  @input="convertToMilliseconds"
                />
              </td>
              <td class="p-2">
                <select-input v-model="editedItem.work_type" :options="project.work_type"></select-input>
              </td>
              <td class="p-2 min-w-70">
                <content-editor
                  v-model="editedItem.descripton"
                  :default="editedItem.description"
                  toolbar="simple"
                ></content-editor>
              </td>
              <td class="p-2">
                <select-input v-model="editedItem.billable" :options="[['Yes','Yes'],['No','No']]"></select-input>
              </td>
              <td class="relative p-2">
                <select-input v-model="editedItem.billed" :options="[['Yes','Yes'],['No','No']]"></select-input>
              </td>
              <td>
                <div class="z-10 w-32 py-2 mt-2 bg-white border rounded">
                  <button
                    class="flex items-center w-full h-8 text-gray-500 fill-current hover:text-blue"
                    @click.stop="saveItem"
                  >
                    <div class="w-8 h-8">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        baseProfile="full"
                        viewBox="0 0 76.00 76.00"
                      >
                        <path
                          d="M20.583 20.583h34.834v34.834h-9.5V44.333H30.083v11.084h-9.5V20.583zM33.25 55.417v-4.75h6.333v4.75H33.25zM26.917 23.75v9.5h22.166v-9.5H26.917z"
                        />
                      </svg>
                    </div>
                    <span class="ml-2">Save</span>
                  </button>
                  <button
                    class="flex items-center w-full h-8 text-gray-500 fill-current hover:text-blue"
                    @click.stop="cancelEdit"
                  >
                    <div class="w-8 h-8">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        baseProfile="full"
                        viewBox="0 0 76.00 76.00"
                      >
                        <path
                          d="M38 19c10.493 0 19 8.507 19 19s-8.507 19-19 19-19-8.507-19-19 8.507-19 19-19zm0 4.75c-2.788 0-5.39.8-7.587 2.185l19.652 19.652A14.183 14.183 0 0 0 52.25 38c0-7.87-6.38-14.25-14.25-14.25zM23.75 38c0 7.87 6.38 14.25 14.25 14.25 2.788 0 5.39-.8 7.587-2.185L25.934 30.414A14.184 14.184 0 0 0 23.75 38z"
                        />
                      </svg>
                    </div>
                    <span class="ml-2">Cancel</span>
                  </button>
                </div>
              </td>
            </template>
          </tr>
        </tbody>
      </table>
    </div>
  </content-paginator>
</template>

<script>
import moment from "moment";
import ContentPaginator from "../Layouts/ContentPaginator";
import DatePicker from "../UI/DatePicker";
import SelectInput from "../UI/SelectInput";
import ContentEditor from "../UI/ContentEditor";

export default {
  components: { ContentPaginator, DatePicker, SelectInput, ContentEditor },
  props: ["project"],
  data() {
    return {
      editedItem: null,
      editWorkTime: null
    };
  },
  methods: {
    editItem(item) {
      console.log(item);
      this.editedItem = { ...item };
      this.editWorkTime = item.work_time;
    },
    convertToMilliseconds(e) {
      let time = e.target.value;
      if (time.includes(":")) {
        this.editedItem.work_time = moment.duration(time).asMilliseconds();
      } else {
        this.editedItem.work_time = parseInt(time);
      }
    },
    convertFromMilliseconds(time) {
      return moment
        .utc(moment.duration(time, "milliseconds").asMilliseconds())
        .format("HH:mm:ss");
    },
    saveItem() {},
    cancelEdit() {
      this.editedItem = null;
    }
  }
};
</script>