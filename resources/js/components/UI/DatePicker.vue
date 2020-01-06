<template>
  <input type="text" @input="setValue" v-model="update_value" />
</template>

<script>
import flatpickr from "flatpickr";

export default {
  name: "DatePicker",
  props: ["placeholder", "value"],
  data() {
    return {
      config: {
        altInput: true,
        dateFormat: "Y-m-d H:i:ss",
        enableTime: false,
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