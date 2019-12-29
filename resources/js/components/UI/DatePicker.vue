<template>
  <div class="w-full focus:shadow-outline">
    <flat-pickr
      class="w-full p-0 m-0 h-10 px-2"
      v-model="update_value"
      :config="config"
      :placeholder="placeholder"
      @input="setValue"
      name="date"
    ></flat-pickr>
  </div>
</template>

<script>
import flatPickr from "vue-flatpickr-component";

export default {
  name: "DatePicker",
  props: ["placeholder", "value"],
  components: { flatPickr },
  data() {
    return {
      config: {
        altInput: true,
        dateFormat: "Y-m-d H:i:ss",
        altFormat: "D F J, Y h:i K",
        enableTime: true,
        disableMobile: "true"
      },
      classes: "p-2 border-2 rounded",
      update_value: this.value
    };
  },
  methods: {
    setValue: function() {
      this.$emit("input", this.update_value);
    }
  }
};
</script>