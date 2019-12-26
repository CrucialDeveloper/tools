<template>
  <div class="p-4">
    <h3
      class="text-2xl mb-4"
    >{{(editProject === undefined || Object.keys(editProject).length ===0)? 'New Project' : 'Edit Project'}}</h3>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="company_name">Company Name</label>
      <input
        type="text"
        name="company_name"
        class="p-2 border rounded w-full"
        placeholder="Best Hardware and Sons"
        v-model="project.company_name"
      />
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="address">Address</label>
      <input
        type="text"
        name="address"
        class="p-2 border rounded w-full"
        placeholder="123 Example St."
        v-model="project.address"
      />
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="city">City</label>
      <input
        type="text"
        name="city"
        class="p-2 border rounded w-full"
        placeholder="Example Town"
        v-model="project.city"
      />
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="state">State</label>
      <select class="appearance-none p-2 border rounded w-full" v-model="project.state">
        <option disabled selected hidden>Select State ...</option>
        <option value="AL">Alabama</option>
        <option value="AK">Alaska</option>
        <option value="AZ">Arizona</option>
        <option value="AR">Arkansas</option>
        <option value="CA">California</option>
        <option value="CO">Colorado</option>
        <option value="CT">Connecticut</option>
        <option value="DE">Delaware</option>
        <option value="DC">District Of Columbia</option>
        <option value="FL">Florida</option>
        <option value="GA">Georgia</option>
        <option value="HI">Hawaii</option>
        <option value="ID">Idaho</option>
        <option value="IL">Illinois</option>
        <option value="IN">Indiana</option>
        <option value="IA">Iowa</option>
        <option value="KS">Kansas</option>
        <option value="KY">Kentucky</option>
        <option value="LA">Louisiana</option>
        <option value="ME">Maine</option>
        <option value="MD">Maryland</option>
        <option value="MA">Massachusetts</option>
        <option value="MI">Michigan</option>
        <option value="MN">Minnesota</option>
        <option value="MS">Mississippi</option>
        <option value="MO">Missouri</option>
        <option value="MT">Montana</option>
        <option value="NE">Nebraska</option>
        <option value="NV">Nevada</option>
        <option value="NH">New Hampshire</option>
        <option value="NJ">New Jersey</option>
        <option value="NM">New Mexico</option>
        <option value="NY">New York</option>
        <option value="NC">North Carolina</option>
        <option value="ND">North Dakota</option>
        <option value="OH">Ohio</option>
        <option value="OK">Oklahoma</option>
        <option value="OR">Oregon</option>
        <option value="PA">Pennsylvania</option>
        <option value="RI">Rhode Island</option>
        <option value="SC">South Carolina</option>
        <option value="SD">South Dakota</option>
        <option value="TN">Tennessee</option>
        <option value="TX">Texas</option>
        <option value="UT">Utah</option>
        <option value="VT">Vermont</option>
        <option value="VA">Virginia</option>
        <option value="WA">Washington</option>
        <option value="WV">West Virginia</option>
        <option value="WI">Wisconsin</option>
        <option value="WY">Wyoming</option>
      </select>
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="zip">Zip</label>
      <input
        type="text"
        name="zip"
        class="p-2 border rounded w-full"
        placeholder="62285"
        v-model="project.zip"
      />
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="country">Country</label>
      <input
        type="text"
        name="zip"
        class="p-2 border rounded w-full"
        placeholder="USA"
        v-model="project.country"
      />
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="phone_number">Phone Number</label>
      <input
        type="text"
        name="phone_number"
        class="p-2 border rounded w-full"
        placeholder="555-555-5555"
        v-model="project.phone_number"
      />
    </div>
    <div class="mb-4 flex items-center">
      <label class="mr-2 w-48 text-right" for="website">Website</label>
      <input
        type="text"
        name="website"
        class="p-2 border rounded w-full"
        placeholder="https://examplesite.com"
        v-model="project.website"
      />
    </div>

    <div class="flex items-center justify-between">
      <button class="text-gray-600 underline" @click="reset">Cancel</button>
      <button
        class="text-white bg-blue px-4 py-2 rounded"
        @click="saveProject"
        v-if="editProject === undefined || Object.keys(editProject).length===0"
      >Save</button>
      <button class="text-white bg-blue px-4 py-2 rounded" @click="updateProject" v-else>Save</button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["editProject"],
  data() {
    return {
      project: {}
    };
  },
  methods: {
    reset() {
      this.project = {};
      this.$modal.hide(this.$parent.name);
    },
    saveProject() {
      this.$inertia.post("/projects", this.project);
      this.reset();
    },
    updateProject() {
      this.$inertia.patch(this.editProject.path, this.project);
      this.reset();
    }
  },
  created() {
    if (this.editProject) {
      this.project = { ...this.editProject };
    }
  }
};
</script>