<template>
  <div class="relative w-full border rounded">
    <button
      type="text"
      @click.prevent="open"
      class="w-full p-2 text-left bg-white rounded-t"
      :class="[!isOpen? 'rounded-b' : '']"
    >
      <span v-if="value !== ''">{{ value }}</span>
      <span v-else class="text-gray-500">{{placeholder}}</span>
    </button>
    <div
      class="absolute z-10 flex flex-col w-full bg-white border rounded-b shadow"
      v-show="isOpen"
    >
      <input
        ref="search"
        type="text"
        class="p-1 m-2 border rounded"
        v-model="search"
        @keydown.down.prevent="increaseHighlightedIndex"
        @keydown.up.prevent="decreaseHighlightedIndex"
        @keydown.enter.prevent="selectHighlighted"
        @keydown.esc="close"
      />
      <ul class="overflow-y-scroll" ref="options">
        <li
          class="w-full px-4 py-2"
          :class="[highlightedIndex === index ? 'bg-gray-050' :'']"
          v-for="(item, index) in filteredOptions"
          @click="setSelected(item)"
          @mouseover="highlightedIndex = index"
          :key="index"
          :value="valueIndex===0 ? item[valueIndex] : item"
        >{{displayIndex===1 ? item[displayIndex] : item}}</li>
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
      search: "",
      displayIndex: null,
      valueIndex: null
    };
  },
  computed: {
    filteredOptions() {
      let vm = this;
      if (vm.search) {
        return this.options.filter(function(option) {
          if (vm.displayIndex != null) {
            return (
              option[0].toLowerCase().includes(vm.search.toLowerCase()) ||
              option[1].toLowerCase().includes(vm.search.toLowerCase())
            );
          } else {
            return option.toLowerCase().includes(vm.search.toLowerCase());
          }
        });
      }
      return this.options;
    }
  },
  methods: {
    setSelected(option) {
      if (this.valueIndex === 0) {
        this.$emit("input", option[0]);
      } else {
        this.$emit("input", option);
      }
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
  },
  created() {
    if (Array.isArray(this.options[0])) {
      this.valueIndex = 0;
      this.displayIndex = 1;
    }
  }
};
</script>