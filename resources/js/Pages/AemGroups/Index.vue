<template>
  <div class="container p-8 mx-auto">
    <div class="p-4 mx-auto bg-white rounded shadow w-fill max-w-100">
      <div class="w-full mt-4">
        <select
          class="w-full p-2 bg-white border rounded appearance-none"
          :class="info.errors.has('type') ? 'border-red-500':''"
          v-model="info.type"
        >
          <option value>Select Type ...</option>
          <option value="author">Author</option>
          <option value="end user">End User</option>
          <option value="approval">Approval</option>
        </select>
      </div>

      <div class="w-full mt-4">
        <input
          type="text"
          class="w-full p-2 border rounded"
          :class="info.errors.has('site_name') ? 'border-red-500':''"
          placeholder="Site Name ..."
          v-model="info.site_name"
        />
      </div>

      <div class="w-full mt-4">
        <select
          class="w-full p-2 bg-white border appearance-none"
          :class="info.errors.has('bu_short') ? 'border-red-500':''"
          v-model="business_unit"
        >
          <option value>Select Business Unit ...</option>
          <option :value="team" v-for="team in business_units" :key="team[0]">{{team[0]}}</option>
        </select>
      </div>

      <div class="w-full mt-4">
        <input
          type="text"
          class="w-full p-2 border rounded"
          placeholder="Additional teams ..."
          v-model="newTeam"
          @keydown.enter="addTeam()"
        />
        <div>
          <div
            class="inline-block px-2 py-1 mt-2 mr-2 bg-gray-200 rounded"
            v-for="team in info.teams"
            :key="team"
          >
            <span class="mr-2">{{team}}</span>
            <button @click="removeTag(team)">x</button>
          </div>
        </div>
      </div>
      <button
        class="w-full p-2 mt-4 text-center text-white bg-blue-500 rounded"
        @click="generateNames()"
      >Generate Group Names</button>
      <!-- Text Field: Descriptor OR Select: Descriptor (if Content Access) -->
    </div>

    <div class="p-4 mt-8 bg-white rounded shadow" v-if="functional">
      <h2 class="text-2xl">Functional Groups</h2>
      <table class="table-auto">
        <thead>
          <tr>
            <th class="px-4 py-2">Author Group Name</th>
            <th class="px-4 py-2">Group ID</th>
            <th class="px-4 py-2">Member Of</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="result in functional"
            class="border-t rounded hover:bg-gray-100"
            :key="result[0]"
          >
            <td class="px-4 py-2">{{result[0]}}</td>
            <td class="px-4 py-2">{{result[1]}}</td>
            <!-- <td class="px-4 py-2">{{result[0]}}</td> -->
          </tr>
        </tbody>
      </table>
    </div>
    <div class="p-4 mt-8 bg-white rounded shadow" v-if="content">
      <h2 class="text-2xl">Content Groups</h2>
      <table class="table-auto">
        <thead>
          <tr>
            <th class="px-4 py-2">Author Group Name</th>
            <th class="px-4 py-2">Group ID</th>
            <th class="px-4 py-2">Member Of</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="result in content" class="border-t rounded hover:bg-gray-100" :key="result[0]">
            <td class="px-4 py-2">{{result[0]}}</td>
            <td class="px-4 py-2">{{result[1]}}</td>
            <!-- <td class="px-4 py-2">{{result[0]}}</td> -->
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import PublicLayout from "../../components/Layouts/PublicLayout";
import Form from "@johnlowery74/crucial-form";
export default {
  layout: PublicLayout,
  data() {
    return {
      info: new Form({
        type: "",
        site_name: "",
        bu_long: "",
        bu_short: "",
        teams: []
      }),
      newTeam: "",
      business_unit: "",
      functional: null,
      content: null,
      business_units: [
        ["Business Planning", "busplan"],
        ["Communications", "comms"],
        ["Corporate Security", "cps"],
        ["Customer Ops", "custops"],
        ["Diversity & Inclusion", "di"],
        ["Field Ops", "fieldops"],
        ["Finance", "fin"],
        ["Government Affairs", "ga"],
        ["Human Resources", "hr"],
        ["Law-Programming & Products", "lpp"],
        ["Legal", "legal"],
        ["Network Ops", "netops"],
        ["Original Content", "origcont"],
        ["Product & Technology", "prodtech"],
        ["Programming", "prog"],
        ["Sales & Marketing", "salesmark"],
        ["Spectrum Enterprise", "enterprise"],
        ["Spectrum Networks", "networks"],
        ["Spectrum Reach", "reach"]
      ]
    };
  },
  methods: {
    addTeam() {
      if (this.newTeam !== "" && !this.info.teams.includes(this.newTeam)) {
        this.info.teams.push(this.newTeam.toLowerCase());
        this.newTeam = "";
      }
    },
    removeTag(team) {
      this.info.teams.splice(this.info.teams.indexOf(team.toLowerCase()), 1);
    },
    generateNames() {
      this.info.bu_long = this.business_unit[0];
      this.info.bu_short = this.business_unit[1];

      this.info
        .post("/aem-groups")
        .then(response => {
          console.log(response);
          this.functional = response.functional;
          this.content = response.content;
        })
        .catch(errors => {
          console.log(errors);
        });
    }
  }
};
</script>