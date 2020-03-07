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
        <label class="w-48 mr-2 text-right" for="last_name">Title</label>
        <input
          type="text"
          name="title"
          class="w-full p-2 border rounded"
          placeholder="Doe"
          v-model="contact.title"
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
          placeholder="Example Town"
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
          placeholder="(555)555-5555"
          v-model="contact.phone_number"
        />
      </div>
      <div class="flex items-center mt-1">
        <div class="w-48 mr-2"></div>
        <button
          class="w-full p-1 text-white bg-blue-500 rounded hover:bg-blue-600"
          @click="saveNewContact"
        >Save New Contact</button>
      </div>
    </div>
    <div ref="sortContainer" class="mt-4">
      <div v-for="(contact, index) in sortedContacts" :key="contact.id" class="drag-item">
        <contact-details :contact="contact" :client="client" :position="index+1">
          <svg
            class="w-6 h-6 mr-4 text-gray-200 fill-current handle"
            viewBox="0 0 1792 1792"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M1411 541l-355 355 355 355 144-144q29-31 70-14 39 17 39 59v448q0 26-19 45t-45 19h-448q-42 0-59-40-17-39 14-69l144-144-355-355-355 355 144 144q31 30 14 69-17 40-59 40H192q-26 0-45-19t-19-45v-448q0-42 40-59 39-17 69 14l144 144 355-355-355-355-144 144q-19 19-45 19-12 0-24-5-40-17-40-59V192q0-26 19-45t45-19h448q42 0 59 40 17 39-14 69L541 381l355 355 355-355-144-144q-31-30-14-69 17-40 59-40h448q26 0 45 19t19 45v448q0 42-39 59-13 5-25 5-26 0-45-19z"
            />
          </svg>
        </contact-details>
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
        title: "",
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
    saveNewContact() {
      this.contact
        .post(this.client.path + "/contacts", this.contact)
        .then(response => {
          this.sortedContacts = response;
          this.contact.reset();
        });
    },
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
    this.$nextTick(function() {
      window.sortable = new Sortable(this.$refs.sortContainer, {
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
    });
  }
};
</script>