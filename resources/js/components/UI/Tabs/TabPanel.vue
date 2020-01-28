<template>
  <div class="h-full" v-show="show">
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: ["name", "activeTab"],
  data() {
    return {
      show: false
    };
  }
};
</script>