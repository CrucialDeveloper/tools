<template>
  <div class="relative overflow-hidden">
    <div class="overflow-x-scroll overflow-y-visible">
      <table class="text-sm">
        <tr>
          <th class="w-24 max-w-24 md:max-w-64 md:w-64"></th>
          <th
            class="text-left"
            :colspan="index===0?date.days.length:Math.max(...date.days)"
            v-for="(date, index) in dates"
            :key="index"
          >{{date.month}} {{date.year}}</th>
        </tr>
        <tr>
          <th class="min-w-64 w-64 bg-white">&nbsp;</th>
          <template v-for="date in dates">
            <th class="pr-2 text-left" v-for="day in date.days">{{day}}</th>
          </template>
        </tr>
        <tr v-for="item in sortedItems" :key="item.id">
          <th class="w-24 max-w-24 md:max-w-64 md:w-64 py-2 pr-4 bg-white text-left">{{item.title}}</th>
          <template v-for="date in dates">
            <template v-for="day in date.days">
              <td class="m-0 p-0">
                <div
                  :class="{'h-3 w-full bg-blue-300 border-blue-300':inDay(item, date, day)}"
                  :title="inDay(item, date, day) ? dateRange(item) : ''"
                ></div>
              </td>
            </template>
          </template>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import _ from "lodash";

export default {
  props: ["items"],
  data() {
    return {
      sortedItems: _.orderBy(this.items, "title")
    };
  },
  methods: {
    dateRange(item) {
      return `${dateFns.format(
        item.start_date,
        "dddd, MMM Do, YYYY"
      )} - ${dateFns.format(item.due_date, "dddd, MMM Do, YYYY")}`;
    },
    inDay(item, date, day) {
      if (
        Date.parse(date.month.concat(" ", day, ", ", date.year)) ==
          Date.parse(item.start_date) &&
        Date.parse(date.month.concat(" ", day, ", ", date.year)) ==
          Date.parse(item.due_date)
      ) {
        return true;
      }

      return (
        Date.parse(date.month.concat(" ", day, ", ", date.year)) >=
          dateFns.subDays(Date.parse(item.start_date), 1) &&
        Date.parse(date.month.concat(" ", day, ", ", date.year)) <=
          Date.parse(item.due_date)
      );
    }
  },
  computed: {
    dates() {
      let startDates = this.items.map(function(item) {
        return item.start_date;
      });
      let endDates = this.items.map(function(item) {
        return item.due_date;
      });

      let min = Date.parse(_.min(startDates));
      let max = Date.parse(_.max(endDates));
      let weeks = dateFns.differenceInCalendarWeeks(max, min);
      let months = dateFns.differenceInCalendarMonths(max, min);
      let startMonth = dateFns.getMonth(min);
      let startYear = dateFns.getYear(min);

      let currMonth = min;
      let monthsArr = [];

      monthsArr.push({
        month: dateFns.format(new Date(min), "MMMM"),
        year: dateFns.format(new Date(min), "YYYY"),
        days: _.range(
          dateFns.getDate(min),
          dateFns.getDaysInMonth(dateFns.getMonth(min)) + 1
        )
      });

      if (months > 0) {
        for (let i = 1; i < months; i++) {
          let month = dateFns.addMonths(currMonth, i);
          monthsArr.push({
            month: dateFns.format(month, "MMMM"),
            year: dateFns.format(month, "YYYY"),
            days: _.range(1, dateFns.getDaysInMonth(month) + 1)
          });
        }
      }

      if (months > 0) {
        monthsArr.push({
          month: dateFns.format(new Date(max), "MMMM"),
          year: dateFns.format(new Date(max), "YYYY"),
          days: _.range(1, dateFns.getDate(max) + 1)
        });
      }
      return monthsArr;
    }
  }
};
</script>

<style lang="css">
</style>

