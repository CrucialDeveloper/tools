<template>
  <input type="text" @input="setValue" v-model="update_value" />
</template>

<script>
import flatpickr from "flatpickr";
import "../../../../node_modules/flatpickr/dist/flatpickr.css";

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
        enableTime: this.enableTime,
        disableMobile: "true",
        allowInput: true,
        closeOnSelect: true
      },
      classes: "p-2 border-2 rounded",
      update_value: this.value
    };
  },
  methods: {
    setValue: function() {
      this.$emit("input", this.update_value);
    }
  },
  mounted() {
    flatpickr(this.$el, this.config);
  }
};
</script>