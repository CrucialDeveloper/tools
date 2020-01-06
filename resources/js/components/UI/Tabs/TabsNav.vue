<template>
  <div>
    <ul class="flex items-center mb-4 border-b">
      <li
        class="mr-4"
        :class="activeTab === index ? 'border-b-4 border-blue-500 -mb-1':''"
        v-for="(tab, index) in tabs"
        :key="index"
      >
        <button class="px-4 py-2" @click="showTab(index)">{{tab.name}}</button>
      </li>
    </ul>
    <slot></slot>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tabs: null,
      activeTab: 0
    };
  },
  methods: {
    showTab(index) {
      this.$children.forEach(function(tab) {
        tab.show = false;
      });
      this.$children[index].show = true;
      this.activeTab = index;
      localStorage.setItem(window.location.pathname, index);
    }
  },
  mounted() {
    this.tabs = this.$children;
    // let index = Number(localStorage.getItem(window.location.pathname));
    this.showTab(0);
    // this.activeTab = index;
  }
};
</script>