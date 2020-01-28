<template>
  <div>
    <ul class="flex items-center mb-4 border-b">
      <li
        class="mr-4"
        :class="activeTab === index ? 'border-b-4 border-blue-500 -mb-1':''"
        v-for="(tab, index) in tabs"
        :key="index"
      >
        <button
          class="px-4 py-2"
          :class="activeTab === index ? 'focus:outline-none':''"
          @click="showTab(index)"
        >{{tab.name}}</button>
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
      activeTab: 0,
      hash: ""
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
    let index = 0;
    if (this.hash) {
      let names = this.tabs.map(tab => tab.name.toLowerCase());
      if (names.includes(this.hash)) {
        index = names.indexOf(this.hash);
      }
    } else {
      index = Number(localStorage.getItem(window.location.pathname));
    }
    this.showTab(index);
    this.activeTab = index;
  },
  created() {
    this.hash = location.hash.split("#")[1];
  }
};
</script>