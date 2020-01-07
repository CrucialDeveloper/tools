<template>
  <div class="relative border rounded w-full">
    <button
      type="text"
      @click.prevent="open"
      class="p-2 rounded-t w-full text-left bg-white"
      :class="[!isOpen? 'rounded-b' : '']"
    >
      <span v-if="value !== ''">{{ value }}</span>
      <span v-else class="text-gray-500">{{placeholder}}</span>
    </button>
    <div
      class="flex flex-col rounded-b border bg-gray-500 absolute w-full z-10 shadow-lg"
      v-show="isOpen"
    >
      <input
        ref="search"
        type="text"
        class="p-1 rounded m-2 border"
        v-model="search"
        @keydown.down.prevent="increaseHighlightedIndex"
        @keydown.up.prevent="decreaseHighlightedIndex"
        @keydown.enter.prevent="selectHighlighted"
        @keydown.esc="close"
      />
      <ul class="overflow-y-scroll" ref="options">
        <li
          class="px-4 py-2 w-full"
          :class="[highlightedIndex === index ? 'bg-blue-500' :'']"
          v-for="(item, index) in filteredOptions"
          @click="setSelected(item)"
          @mouseover="highlightedIndex = index"
          :key="item[0]"
          :value="item[0]"
        >{{item[1]}}</li>
      </ul>
    </div>
  </div>
</template>


<script>
export default {
  name: "SelectInput",
  props: ["options", "value", "placeholder"],
  data() {
    return {
      highlightedIndex: 0,
      isOpen: false,
      search: ""
    };
  },
  computed: {
    filteredOptions() {
      let vm = this;
      if (vm.search) {
        return this.options.filter(function(option) {
          return (
            option[0].toLowerCase().includes(vm.search.toLowerCase()) ||
            option[1].toLowerCase().includes(vm.search.toLowerCase())
          );
        });
      }
      return this.options;
    }
  },
  methods: {
    setSelected(option) {
      this.$emit("input", option[0]);
      this.search = "";
      this.close();
    },
    selectHighlighted() {
      this.setSelected(this.filteredOptions[this.highlightedIndex]);
    },
    increaseHighlightedIndex(e) {
      this.highlightedIndex = this.highlightedIndex + 1;
      if (this.highlightedIndex >= this.filteredOptions.length) {
        this.highlightedIndex = 0;
      }
      this.scrollToHighlighted();
    },
    decreaseHighlightedIndex(e) {
      this.highlightedIndex = this.highlightedIndex - 1;
      if (this.highlightedIndex < 0) {
        this.highlightedIndex = this.filteredOptions.length - 1;
      }
      this.scrollToHighlighted();
    },
    open() {
      this.isOpen = true;
      this.$nextTick(function() {
        this.$refs.search.focus();
      });
      this.highlightedIndex = 0;
      this.$nextTick(function() {
        this.scrollToHighlighted(0);
      });
    },
    close() {
      this.highlightedIndex = 0;
      this.isOpen = false;
    },
    scrollToHighlighted(index) {
      this.$refs.options.children[
        index ? index : this.highlightedIndex
      ].scrollIntoView({
        block: "nearest"
      });
    }
  },
  beforeDestroy() {
    document.removeEventListener("click", function(e) {
      if (e.target === vm.$el || vm.$el.contains(e.target)) {
        return;
      }
      vm.close();
    });
  },
  mounted() {
    let vm = this;
    document.addEventListener("click", function(e) {
      if (e.target === vm.$el || vm.$el.contains(e.target)) {
        return;
      }
      vm.close();
    });
  }
};
</script>