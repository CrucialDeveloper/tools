<template>
  <div class="container p-8 mx-auto">
    <div class="p-4 mx-auto bg-white rounded shadow w-fill max-w-100">
      <div class="w-full mt-4">
        <select
          class="w-full p-2 bg-white border rounded appearance-none"
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
          placeholder="Site Name ..."
          v-model="info.site_name"
        />
      </div>

      <div class="w-full mt-4">
        <select
          class="w-full p-2 bg-white border appearance-none"
          v-model="business_unit"
        >
          <option value>Select Business Unit ...</option>
          <option :value="team" v-for="team in business_units" :key="team[0]">
            {{ team[0] }}
          </option>
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
            <span class="mr-2">{{ team }}</span>
            <button @click="removeTag(team)">x</button>
          </div>
        </div>
      </div>
      <button
        class="w-full p-2 mt-4 text-center text-white bg-blue-500 rounded"
        @click="generateNames()"
      >
        Generate Group Names
      </button>
      <!-- Text Field: Descriptor OR Select: Descriptor (if Content Access) -->
    </div>

    <div class="p-4 mt-8 bg-white rounded shadow" v-if="functional">
      <h2 class="text-2xl">Functional Groups</h2>
      <table class="table-auto">
        <thead>
          <tr>
            <th class="px-4 py-2">Author Group Name</th>
            <th class="px-4 py-2">Member Of</th>
            <th class="px-4 py-2">Group ID</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="result in functional"
            class="border-t rounded hover:bg-gray-100"
            :key="result[0]"
          >
            <td class="px-4 py-2">{{ result[1] }}</td>
            <td class="px-4 py-2">{{ result[0] }}</td>
            <td class="px-4 py-2 underline">
              <a :href="result[3]" target="_blank">
                {{ result[2] }}
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="p-4 mt-8 bg-white rounded shadow" v-if="content">
      <h2 class="text-2xl">Content Groups</h2>
      <div class="mt-4">
        <div class="w-full bg-gray-200">
          <h3 class="font-bold text-center">Business Unit Level</h3>
        </div>
        <table class="table-auto">
          <thead>
            <tr>
              <th class="px-4 py-2">Group ID</th>
              <th class="px-4 py-2">Author Group Name</th>
              <th class="px-4 py-2">Member Of</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="border-t rounded hover:bg-gray-100"
              v-for="result in content.bu"
              :key="result[0]"
            >
              <td class="px-4 py-2">{{ result[1] }}</td>
              <td class="px-4 py-2">{{ result[0] }}</td>
              <td class="px-4 py-2">{{ result[2] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="mt-4" v-if="content.teams.length > 0">
        <div class="w-full bg-gray-200">
          <h3 class="font-bold text-center">Team Level</h3>
        </div>
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
              class="border-t rounded hover:bg-gray-100"
              v-for="result in content.teams"
              :key="result[0]"
            >
              <td class="px-4 py-2">{{ result[0] }}</td>
              <td class="px-4 py-2">{{ result[1] }}</td>
              <td class="px-4 py-2">{{ result[2] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import PublicLayout from "../../components/Layouts/PublicLayout";

export default {
  layout: PublicLayout,
  data() {
    return {
      info: {
        type: "",
        site_name: "",
        bu_long: "",
        bu_short: "",
        teams: [],
      },
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
        ["External Communications", "extcomms"],
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
        ["Real Estate & Facilities", "facilities"],
        ["Sales & Marketing", "salesmark"],
        ["Spectrum Enterprise", "enterprise"],
        ["Spectrum Networks", "networks"],
        ["Spectrum Originals", "originals"],
        ["Spectrum Reach", "reach"],
      ],
    };
  },
  methods: {
    addTeam() {
      if (this.newTeam !== "" && !this.info.teams.includes(this.newTeam)) {
        this.info.teams.push(this.newTeam);
        this.newTeam = "";
      }
    },
    removeTag(team) {
      this.info.teams.splice(this.info.teams.indexOf(team.toLowerCase()), 1);
    },
    generateNames() {
      this.info.bu_long = this.business_unit[0];
      this.info.bu_short = this.business_unit[1];
      let form = this;
      axios
        .post("/aem-groups", this.info)
        .then((response) => {
          form.functional = response.data.functional;
          form.content = response.data.content;
        })
        .catch((errors) => {
        });
    },
  },
};
</script>
