<template>
  <div>
    <div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right" for="first_name">First Name</label>
        <input
          type="text"
          name="first_name"
          class="w-full p-2 border rounded"
          placeholder="John"
          v-model="contact.first_name"
        />
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right" for="last_name">Last Name</label>
        <input
          type="text"
          name="last_name"
          class="w-full p-2 border rounded"
          placeholder="Doe"
          v-model="contact.last_name"
        />
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right" for="email">Email</label>
        <input
          type="text"
          name="email"
          class="w-full p-2 border rounded"
          placeholder="john@example.com"
          v-model="contact.email"
        />
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right" for="address">Address</label>
        <input
          type="text"
          name="address"
          class="w-full p-2 border rounded"
          placeholder="123 Example St."
          v-model="contact.address"
        />
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right" for="city">City</label>
        <input
          type="text"
          name="city"
          class="w-full p-2 border rounded"
          placeholder="ExampleTown"
          v-model="contact.city"
        />
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right" for="state">State</label>
        <select-input
          placeholder="Select State ..."
          :options="states"
          v-model="contact.state"
          :value="contact.state"
        ></select-input>
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right" for="zip">Zip</label>
        <input
          type="text"
          name="zip"
          class="w-full p-2 border rounded"
          placeholder="zip"
          v-model="contact.zip"
        />
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right" for="phone_number">Phone Number</label>
        <input
          type="text"
          name="phone_number"
          class="w-full p-2 border rounded"
          placeholder="phone_number"
          v-model="contact.phone_number"
        />
      </div>
      <div class="flex items-center mt-1">
        <div class="w-48 mr-2"></div>
        <button
          class="w-full p-1 text-white bg-blue-500 rounded hover:bg-blue-600"
          @click="saveClient"
        >Save Contact</button>
      </div>
    </div>
    <div ref="sortContainer mt-4">
      <div v-for="(contact, index) in sortedContacts" :key="contact.id" class="drag-item">
        <contact-details :contact="contact" :client="client" :position="index+1"></contact-details>
      </div>
    </div>
  </div>
</template>

<script>
import ContactDetails from "./ContactDetails";
import SelectInput from "../UI/SelectInput";
import { Sortable, Plugins } from "@shopify/draggable";
import Form from "@johnlowery74/crucial-form";
import states from "../../JSON/states.json";

export default {
  components: { ContactDetails, SelectInput },
  props: ["contacts", "client"],
  data() {
    return {
      sortedContacts: this.contacts,
      contact: new Form({
        first_name: "",
        last_name: "",
        email: "",
        address: "",
        city: "",
        state: "",
        zip: "",
        phone_number: ""
      }),
      states: states
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