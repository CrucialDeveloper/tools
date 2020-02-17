<template>
  <div>
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
  methods: {
    setScrollArea() {
      this.height = window.innerHeight - this.$el.offsetTop - 14 + "px";
      this.$el.firstChild.style.height = this.height;
      this.$el.firstChild.style.overflowY = "scroll";
      this.$el.style.height = this.height;
    }
  },
  mounted() {
    this.setScrollArea();
    window.addEventListener("resize", e => {
      this.setScrollArea();
    });
  }
};
</script>