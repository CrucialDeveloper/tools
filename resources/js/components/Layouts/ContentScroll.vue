<template>
  <div class="overflow-y-scroll" :style="{height:height, maxHeight:maxHeight}">
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: ["maxHeight"],
  data() {
    console.log(this.$el);
    return {
      height: ""
    };
  },
  mounted() {
    this.height = window.innerHeight - this.$el.offsetTop - 28 + "px";
  }
};
</script>