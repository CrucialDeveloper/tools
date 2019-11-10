<template>
  <div>
    <div class="bg-white rounded p-4 shadow-md flex">
      <div class="w-1/2 mr-4">
        <google-map :client="client"></google-map>
      </div>
      <div class="w-1/2">
        <div class="flex items-start justify-between mb-4">
          <h2 class="text-2xl mr-4">{{client.company_name}}</h2>
          <a class="text-blue hover:underline" :href="client.website" target="_blank">Visit Website</a>
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
  </div>
</template>

<script>
import GoogleMap from "../../components/GoogleMap";

export default {
  components: { GoogleMap },
  props: ["client"]
};
</script>