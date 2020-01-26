<template>
  <div :style="{height:height, maxHeight:maxHeight}">
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: ["maxHeight"],
  data() {
    return {
      height: ""
    };
  },
  mounted() {
    this.height = window.innerHeight - this.$el.offsetTop - 14 + "px";
  }
};
</script>