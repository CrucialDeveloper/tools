<template>
  <div ref="sortContainer">
    <div v-for="(contact, index) in sortedContacts" :key="contact.id" class="drag-item">
      <contact-details :contact="contact" :client="client" :position="index+1"></contact-details>
    </div>
  </div>
</template>

<script>
import ContactDetails from "./ContactDetails";
import { Sortable, Plugins } from "@shopify/draggable";

export default {
  components: { ContactDetails },
  props: ["contacts", "client"],
  data() {
    return {
      sortedContacts: this.contacts
    };
  },
  methods: {
    move(arr, from, to) {
      var element = arr[from];
      arr.splice(from, 1);
      arr.splice(to, 0, element);
      return arr;
    },
    setOrder(from, to) {
      if (from != to) {
        this.move(this.sortedContacts, from, to);
        let order = {};
        this.sortedContacts.forEach((contact, index) => {
          order[contact.id] = index;
        });
        axios.patch(this.client.path + "/contacts/", { order: order });
      }
    }
  },
  mounted() {
    const sortable = new Sortable(this.$refs.sortContainer, {
      handle: ".handle",
      draggable: ".drag-item",
      swapAnimation: {
        duration: 100,
        easingFunction: "ease-in-out"
      },
      plugins: [Plugins.SwapAnimation]
    });
    sortable.on("sortable:stop", e => {
      this.setOrder(e.data.oldIndex, e.data.newIndex);
    });
  }
};
</script>