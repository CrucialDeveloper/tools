<template>
  <div class="mt-4 mr-4">
    <div class="flex items-start">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="w-6 h-6 mr-4 text-gray-200 fill-current"
      >
        <path
          d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"
        />
      </svg>
      <div class="text-gray-500">
        <div>{{contact.first_name}} {{contact.last_name}}</div>
        <div class="hover:underline">
          <a :href="`mailto:${contact.email}`">{{contact.email}}</a>
        </div>
        <div>{{contact.phone_number}}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["contact"]
};
</script>

