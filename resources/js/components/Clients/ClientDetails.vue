<template>
  <div class="flex w-full bg-white p-4 rounded shadow">
    <div class="w-1/2 mr-4">
      <div class="shadow rounded">
        <google-map :client="client" v-if="client.address"></google-map>
        <img
          v-if="!client.address"
          class="rounded"
          style="height:400px; width:400px"
          src="/images/no-address.png"
          alt="No Address For This Client"
        />
      </div>
    </div>
    <div class="w-1/2">
      <div class="flex items-start justify-between mb-4 w-full">
        <div class="flex items-center justify-between mr-4 w-full">
          <h2 class="text-2xl mr-4">{{client.company_name}}</h2>
          <button class="h-5 w-5 text-gray-500" @click="editClient(client)">
            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
              <path
                d="M6 34.5V42h7.5l22.13-22.13-7.5-7.5L6 34.5zm35.41-20.41c.78-.78.78-2.05 0-2.83l-4.67-4.67c-.78-.78-2.05-.78-2.83 0l-3.66 3.66 7.5 7.5 3.66-3.66z"
              />
            </svg>
          </button>
        </div>
      </div>
      <div class="flex items-start mb-4">
        <span class="w-6 h-6 mr-4">
          <svg
            class="text-gray-500 fill-current"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path
              d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm7.75-8a8.01 8.01 0 0 0 0-4h-3.82a28.81 28.81 0 0 1 0 4h3.82zm-.82 2h-3.22a14.44 14.44 0 0 1-.95 3.51A8.03 8.03 0 0 0 16.93 14zm-8.85-2h3.84a24.61 24.61 0 0 0 0-4H8.08a24.61 24.61 0 0 0 0 4zm.25 2c.41 2.4 1.13 4 1.67 4s1.26-1.6 1.67-4H8.33zm-6.08-2h3.82a28.81 28.81 0 0 1 0-4H2.25a8.01 8.01 0 0 0 0 4zm.82 2a8.03 8.03 0 0 0 4.17 3.51c-.42-.96-.74-2.16-.95-3.51H3.07zm13.86-8a8.03 8.03 0 0 0-4.17-3.51c.42.96.74 2.16.95 3.51h3.22zm-8.6 0h3.34c-.41-2.4-1.13-4-1.67-4S8.74 3.6 8.33 6zM3.07 6h3.22c.2-1.35.53-2.55.95-3.51A8.03 8.03 0 0 0 3.07 6z"
            />
          </svg>
        </span>

        <a
          class="block text-gray-600 hover:underline"
          :href="client.website"
          target="_blank"
        >Visit Website</a>
      </div>
      <div class="flex items-start justify-between mb-4">
        <div class="flex items-start mr-8">
          <span class="w-6 h-6 mr-4">
            <svg
              class="text-gray-500 fill-current"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 48 48"
            >
              <path
                d="M36 16c0-6.63-5.37-12-12-12S12 9.37 12 16c0 9 12 22 12 22s12-13 12-22zm-16 0c0-2.21 1.79-4 4-4s4 1.79 4 4-1.79 4-4 4-4-1.79-4-4zM10 40v4h28v-4H10z"
              />
            </svg>
          </span>
          <div>
            <span class="block text-gray-600">{{client.address}}</span>
            <span class="block text-gray-600">{{client.city}}, {{client.state}} {{client.zip}}</span>
          </div>
        </div>
        <div class="flex items-center">
          <span class="w-6 h-6 mr-4">
            <svg
              class="text-gray-500 fill-current"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 48 48"
            >
              <path
                d="M13.25 21.59c2.88 5.66 7.51 10.29 13.18 13.17l4.4-4.41c.55-.55 1.34-.71 2.03-.49C35.1 30.6 37.51 31 40 31c1.11 0 2 .89 2 2v7c0 1.11-.89 2-2 2C21.22 42 6 26.78 6 8c0-1.11.9-2 2-2h7c1.11 0 2 .89 2 2 0 2.49.4 4.9 1.14 7.14.22.69.06 1.48-.49 2.03l-4.4 4.42z"
              />
            </svg>
          </span>
          <span class="block text-gray-600">{{client.phone_number}}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import GoogleMap from "../../components/UI/GoogleMap";
import ClientModal from "./ClientModal";

export default {
  components: { GoogleMap, ClientModal },
  props: ["client"],
  methods: {
    editClient(client) {
      this.$modal.show(
        ClientModal,
        { editClient: client },
        {
          adaptive: true,
          height: "auto"
        }
      );
    }
  }
};
</script>