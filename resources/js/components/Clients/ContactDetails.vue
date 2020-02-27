<template>
  <div class="mt-4">
    <div class="p-4 border rounded">
      <div class="flex items center">
        <svg
          class="w-6 h-6 mr-4 text-gray-200 fill-current handle"
          viewBox="0 0 1792 1792"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M1411 541l-355 355 355 355 144-144q29-31 70-14 39 17 39 59v448q0 26-19 45t-45 19h-448q-42 0-59-40-17-39 14-69l144-144-355-355-355 355 144 144q31 30 14 69-17 40-59 40H192q-26 0-45-19t-19-45v-448q0-42 40-59 39-17 69 14l144 144 355-355-355-355-144 144q-19 19-45 19-12 0-24-5-40-17-40-59V192q0-26 19-45t45-19h448q42 0 59 40 17 39-14 69L541 381l355 355 355-355-144-144q-31-30-14-69 17-40 59-40h448q26 0 45 19t19 45v448q0 42-39 59-13 5-25 5-26 0-45-19z"
          />
        </svg>
        <h3 class="font-bold handle">Contact {{position}}</h3>
      </div>
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
    </div>
  </div>
</template>

<script>
import Form from "@johnlowery74/crucial-form";
import SelectInput from "../../components/UI/SelectInput";
import states from "../../JSON/states.json";

export default {
  components: { Form, SelectInput },
  props: ["contact", "position"],
  data() {
    return {
      editedContacts: new Form({
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
  }
};
</script>