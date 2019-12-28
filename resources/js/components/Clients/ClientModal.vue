<template>
  <div class="p-4">
    <h3
      class="text-2xl mb-4"
    >{{(editClient === undefined || Object.keys(editClient).length ===0)? 'New Client' : 'Edit Client'}}</h3>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="company_name">Company Name</label>
      <input
        type="text"
        name="company_name"
        class="p-2 rounded w-full"
        :class="client.errors.has('company_name') ? 'border border-red': 'border'"
        placeholder="Best Hardware and Sons"
        v-model="client.company_name"
      />
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="address">Address</label>
      <input
        type="text"
        name="address"
        class="p-2 rounded w-full"
        :class="client.errors.has('address') ? 'border border-red': 'border'"
        placeholder="123 Example St."
        v-model="client.address"
      />
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="city">City</label>
      <input
        type="text"
        name="city"
        class="p-2 rounded w-full"
        :class="client.errors.has('city') ? 'border border-red': 'border'"
        placeholder="Example Town"
        v-model="client.city"
      />
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="state">State</label>
      <select-input placeholder="Select State ..." :options="states" v-model="client.state"></select-input>
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="zip">Zip</label>
      <input
        type="text"
        name="zip"
        class="p-2 rounded w-full"
        :class="client.errors.has('zip') ? 'border border-red': 'border'"
        placeholder="62285"
        v-model="client.zip"
      />
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="country">Country</label>
      <input
        type="text"
        name="zip"
        class="p-2 rounded w-full"
        :class="client.errors.has('country') ? 'border border-red': 'border'"
        placeholder="USA"
        v-model="client.country"
      />
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="phone_number">Phone Number</label>
      <input
        type="text"
        name="phone_number"
        class="p-2 rounded w-full"
        :class="client.errors.has('phone_number') ? 'border border-red': 'border'"
        placeholder="555-555-5555"
        v-model="client.phone_number"
      />
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="website">Website</label>
      <input
        type="text"
        name="website"
        class="p-2 rounded w-full"
        :class="client.errors.has('website') ? 'border border-red': 'border'"
        placeholder="https://examplesite.com"
        v-model="client.website"
      />
    </div>

    <div class="flex items-center justify-between">
      <div class="flex items-center mr-4">
        <button class="text-red-500 underline mr-4" @click="deleteClient">Delete</button>
      </div>
      <div class="flex items-center">
        <button class="text-gray-600 underline mr-4" @click="reset">Cancel</button>
        <button
          class="text-white bg-blue px-4 py-2 rounded"
          @click="saveClient"
          v-if="editClient === undefined || Object.keys(editClient).length===0"
        >Save</button>
        <button class="text-white bg-blue px-4 py-2 rounded" @click="updateClient" v-else>Save</button>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "@johnlowery74/crucial-form";
import SelectInput from "../UI/SelectInput";
import states from "../../JSON/states.json";

export default {
  components: { SelectInput },
  props: ["editClient"],
  data() {
    return {
      client: new Form({
        company_name: "",
        address: "",
        city: "",
        state: "",
        zip: "",
        country: "",
        phone_number: "",
        website: ""
      }),
      states: states
    };
  },
  methods: {
    reset() {
      this.client.reset();
      this.$modal.hide(this.$parent.name);
    },
    saveClient() {
      this.client
        .post("/clients", this.client)
        .then(response => {
          this.client.reset();
          this.$modal.hide(this.$parent.name);
          this.$inertia.visit(response);
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    updateClient() {
      this.client
        .patch(this.client.path, this.client)
        .then(response => {
          this.client.reset();
          this.$modal.hide(this.$parent.name);
          this.$inertia.visit(response);
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    deleteClient() {
      this.client.delete(this.client.path).then(response => {
        this.client.reset();
        this.$modal.hide(this.$parent.name);
        this.$inertia.visit(response);
      });
    }
  },
  created() {
    if (this.editClient) {
      this.client = new Form({ ...this.editClient });
    }
  }
};
</script>