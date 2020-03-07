<template>
  <div class="mt-4">
    <div class="p-4 border rounded">
      <div class="flex items center">
        <slot></slot>
        <div class="flex justify-between w-full">
          <h3 class="mr-4 font-bold select-none handle">Contact {{position}}</h3>
          <div>
            <button
              class="mr-4 text-red-500 underline hover:text-red-600"
              @click="deleteContact"
            >Delete</button>
            <button
              class="p-2 bg-gray-200 border rounded hover:bg-gray-300"
              @click="saveContact"
              v-if="changed"
            >Save</button>
          </div>
        </div>
      </div>
      <div class="flex items-center mt-2">
        <label class="w-48 mr-2 text-right select-none" for="first_name">First Name</label>
        <input
          type="text"
          name="first_name"
          class="w-full p-2 border rounded"
          placeholder="John"
          v-model="editedContact.first_name"
        />
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right select-none" for="last_name">Last Name</label>
        <input
          type="text"
          name="last_name"
          class="w-full p-2 border rounded"
          placeholder="Doe"
          v-model="editedContact.last_name"
        />
      </div>
      <div class="flex items-center mt-2">
        <label class="w-48 mr-2 text-right select-none" for="first_name">Title</label>
        <input
          type="text"
          name="title"
          class="w-full p-2 border rounded"
          placeholder="Manager"
          v-model="editedContact.title"
        />
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right select-none" for="email">Email</label>
        <input
          type="text"
          name="email"
          class="w-full p-2 border rounded"
          placeholder="john@example.com"
          v-model="editedContact.email"
        />
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right select-none" for="address">Address</label>
        <input
          type="text"
          name="address"
          class="w-full p-2 border rounded"
          placeholder="123 Example St."
          v-model="editedContact.address"
        />
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right select-none" for="city">City</label>
        <input
          type="text"
          name="city"
          class="w-full p-2 border rounded"
          placeholder="ExampleTown"
          v-model="editedContact.city"
        />
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right select-none" for="state">State</label>
        <select-input
          placeholder="Select State ..."
          :options="states"
          v-model="editedContact.state"
          :value="contact.state"
        ></select-input>
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right select-none" for="zip">Zip</label>
        <input
          type="text"
          name="zip"
          class="w-full p-2 border rounded"
          placeholder="zip"
          v-model="editedContact.zip"
        />
      </div>
      <div class="flex items-center mt-1">
        <label class="w-48 mr-2 text-right select-none" for="phone_number">Phone Number</label>
        <input
          type="text"
          name="phone_number"
          class="w-full p-2 border rounded"
          placeholder="phone_number"
          v-model="editedContact.phone_number"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Form from "@johnlowery74/crucial-form";
import SelectInput from "../../components/UI/SelectInput";
import states from "../../JSON/states.json";

export default {
  components: { Form, SelectInput },
  props: ["contact", "position", "client"],
  data() {
    return {
      editedContact: new Form({
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
    saveContact() {
      this.editedContact
        .patch(
          this.client.path + "/contacts/" + this.editedContact.id,
          this.editedContact
        )
        .then(response => {
          this.editedContact = new Form({ ...response[0] });
          this.contact = new Form({ ...response[0] });
        })
        .catch(errors => console.log(errors));
    },
    deleteContact() {
      this.editedContact
        .delete(this.client.path + "/contacts/" + this.editedContact.id)
        .then(response => console.log(response))
        .catch(errors => console.log(errors));
    }
  },
  computed: {
    changed() {
      return (
        this.editedContact.first_name !=
          this.editedContact.originalData.first_name ||
        this.editedContact.last_name !=
          this.editedContact.originalData.last_name ||
        this.editedContact.title != this.editedContact.originalData.title ||
        this.editedContact.email != this.editedContact.originalData.email ||
        this.editedContact.address != this.editedContact.originalData.address ||
        this.editedContact.city != this.editedContact.originalData.city ||
        this.editedContact.state != this.editedContact.originalData.state ||
        this.editedContact.zip != this.editedContact.originalData.zip ||
        this.editedContact.phone_number !=
          this.editedContact.originalData.phone_number
      );
    }
  },
  created() {
    this.editedContact = new Form({ ...this.contact });
  }
};
</script>