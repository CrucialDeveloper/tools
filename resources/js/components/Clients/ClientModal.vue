<template>
  <div class="p-4">
    <h3
      class="mb-4 text-2xl"
    >{{(editClient === undefined || Object.keys(editClient).length ===0)? 'New Client' : 'Edit Client'}}</h3>

    <tabs-nav :saveLast="false">
      <tab-panel name="General">
        <div class="flex items-center mb-4">
          <label class="w-48 mr-2 text-right" for="company_name">Company Name</label>
          <input
            type="text"
            name="company_name"
            class="w-full p-2 rounded"
            :class="client.errors.has('company_name') ? 'border border-red': 'border'"
            placeholder="Best Hardware and Sons"
            v-model="client.company_name"
          />
        </div>
        <div class="flex items-center mb-4">
          <label class="w-48 mr-2 text-right" for="address">Address</label>
          <input
            type="text"
            name="address"
            class="w-full p-2 rounded"
            :class="client.errors.has('address') ? 'border border-red': 'border'"
            placeholder="123 Example St."
            v-model="client.address"
          />
        </div>
        <div class="flex items-center mb-4">
          <label class="w-48 mr-2 text-right" for="city">City</label>
          <input
            type="text"
            name="city"
            class="w-full p-2 rounded"
            :class="client.errors.has('city') ? 'border border-red': 'border'"
            placeholder="Example Town"
            v-model="client.city"
          />
        </div>
        <div class="flex items-center mb-4">
          <label class="w-48 mr-2 text-right" for="state">State</label>
          <select-input
            placeholder="Select State ..."
            :options="states"
            v-model="client.state"
            :value="client.state"
            :class="client.errors.has('state') ? 'border border-red': 'border'"
          ></select-input>
        </div>
        <div class="flex items-center mb-4">
          <label class="w-48 mr-2 text-right" for="zip">Zip</label>
          <input
            type="text"
            name="zip"
            class="w-full p-2 rounded"
            :class="client.errors.has('zip') ? 'border border-red': 'border'"
            placeholder="62285"
            v-model="client.zip"
          />
        </div>
        <div class="flex items-center mb-4">
          <label class="w-48 mr-2 text-right" for="country">Country</label>
          <input
            type="text"
            name="zip"
            class="w-full p-2 rounded"
            :class="client.errors.has('country') ? 'border border-red': 'border'"
            placeholder="USA"
            v-model="client.country"
          />
        </div>
        <div class="flex items-center mb-4">
          <label class="w-48 mr-2 text-right" for="phone_number">Phone Number</label>
          <input
            type="text"
            name="phone_number"
            class="w-full p-2 rounded"
            :class="client.errors.has('phone_number') ? 'border border-red': 'border'"
            placeholder="555-555-5555"
            v-model="client.phone_number"
          />
        </div>
        <div class="flex items-center mb-4">
          <label class="w-48 mr-2 text-right" for="website">Website</label>
          <input
            type="text"
            name="website"
            class="w-full p-2 rounded"
            :class="client.errors.has('website') ? 'border border-red': 'border'"
            placeholder="https://examplesite.com"
            v-model="client.website"
          />
        </div>
      </tab-panel>

      <tab-panel name="Project Status Options">
        <sort-list v-model="client.project_status_options"></sort-list>
      </tab-panel>
    </tabs-nav>

    <div class="flex items-center justify-between">
      <div class="flex items-center mr-4">
        <button class="mr-4 text-red-500 underline" @click="deleteClient">Delete</button>
      </div>
      <div class="flex items-center">
        <button class="mr-4 text-gray-600 underline" @click="reset">Cancel</button>
        <button
          class="px-4 py-2 text-white rounded bg-blue"
          @click="saveClient"
          v-if="editClient === undefined || Object.keys(editClient).length===0"
        >Save</button>
        <button class="px-4 py-2 text-white rounded bg-blue" @click="updateClient" v-else>Save</button>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "@johnlowery74/crucial-form";
import SelectInput from "../UI/SelectInput";
import states from "../../JSON/states.json";
import TabsNav from "../UI/Tabs/TabsNav";
import TabPanel from "../UI/Tabs/TabPanel";
import SortList from "../UI/SortList";

export default {
  components: { SelectInput, Form, TabsNav, TabPanel, SortList },
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
        website: "",
        project_status_options: [
          "New",
          "Spike",
          "Not Started",
          "In Progress",
          "On Hold",
          "Completed"
        ]
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