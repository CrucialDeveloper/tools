<template>
  <input type="text" @input="emitValue" v-model="update_value" :placeholder="placeholder" />
</template>

<script>
import flatpickr from "flatpickr";
import { format, addMinutes, subMinutes, addHours } from "date-fns";

export default {
  name: "DatePicker",
  props: {
    placeholder: { type: String },
    value: { type: String },
    enableTime: { type: Boolean },
    format: { type: String, default: "Y-m-d H:i:S" },
    noCalendar: { type: Boolean, default: false }
  },
  data() {
    return {
      config: {
        dateFormat: this.format,
        altFormat: "Y-m-d h:i K",
        enableTime: this.enableTime,
        disableMobile: "true",
        allowInput: true,
        closeOnSelect: true
      },
      classes: "p-2 border-2 rounded",
      update_value: ""
    };
  },
  methods: {
    emitValue: function() {
      let uDate = new Date(this.update_value);
      let offset = uDate.getTimezoneOffset();
      let localDate =
        offset < 0 ? subMinutes(uDate, offset) : addMinutes(uDate, offset);
      this.$emit("input", format(localDate, "yyyy-MM-dd H:mm:ss"));
    },
    setValue() {
      let uDate = new Date(this.value);
      let offset = uDate.getTimezoneOffset();
      let localDate =
        offset < 0 ? subMinutes(uDate, offset) : addMinutes(uDate, offset);
      this.update_value = format(localDate, "yyyy-MM-dd h:mm a");
    }
  },
  mounted() {
    if (this.value) {
      this.setValue();
    }

    flatpickr(this.$el, this.config);
  }
};
</script>
