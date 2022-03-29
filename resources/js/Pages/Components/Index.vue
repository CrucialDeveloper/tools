<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="px-4 sm:px-6 lg:px-8 mx-4">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Component</h1>
        <p class="mt-2 text-sm text-gray-700">
          A list of all pages that have a reference or dyanmic reference
          component as content
        </p>
      </div>
    </div>
    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle">
          <div class="shadow-sm ring-1 ring-black ring-opacity-5">
            <table
              class="min-w-full border-separate text-sm"
              style="border-spacing: 0"
            >
              <thead class="bg-gray-100">
                <tr>
                  <th
                    scope="col"
                    class="
                      sticky
                      top-0
                      z-10
                      border-b border-gray-300
                      bg-gray-100
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-gray-900
                      backdrop-blur backdrop-filter
                      sm:pl-6
                      lg:pl-8
                    "
                  ></th>
                  <th
                    scope="col"
                    class="
                      sticky
                      top-0
                      z-10
                      border-b border-gray-300
                      bg-gray-100
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-gray-900
                      backdrop-blur backdrop-filter
                      sm:pl-6
                      lg:pl-8
                      w-64
                    "
                  >
                    Page
                  </th>
                  <th
                    scope="col"
                    class="
                      sticky
                      top-0
                      z-10
                      border-b border-gray-300
                      bg-gray-100
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-gray-900
                      backdrop-blur backdrop-filter
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    Team Site
                  </th>
                  <th
                    scope="col"
                    class="
                      sticky
                      top-0
                      z-10
                      border-b border-gray-300
                      bg-gray-100
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-gray-900
                      backdrop-blur backdrop-filter
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    Team
                  </th>
                  <th
                    scope="col"
                    class="
                      sticky
                      top-0
                      z-10
                      border-b border-gray-300
                      bg-gray-100
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-gray-900
                      backdrop-blur backdrop-filter
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    Urls
                  </th>
                  <th
                    scope="col"
                    class="
                      sticky
                      top-0
                      z-10
                      border-b border-gray-300
                      bg-gray-100
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-gray-900
                      backdrop-blur backdrop-filter
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    Status
                  </th>
                  <th
                    scope="col"
                    class="
                      sticky
                      top-0
                      z-10
                      border-b border-gray-300
                      bg-gray-100
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-gray-900
                      backdrop-blur backdrop-filter
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    Assigned To
                  </th>
                  <th
                    scope="col"
                    class="
                      sticky
                      top-0
                      z-10
                      border-b border-gray-300
                      bg-gray-100
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-gray-900
                      backdrop-blur backdrop-filter
                      sm:pl-6
                      lg:pl-8
                      w-80
                    "
                  >
                    Notes
                  </th>
                  <th
                    scope="col"
                    class="
                      sticky
                      top-0
                      z-10
                      border-b border-gray-300
                      bg-gray-100
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-gray-900
                      backdrop-blur backdrop-filter
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    Fragments
                  </th>
                  <th
                    scope="col"
                    class="
                      sticky
                      top-0
                      z-10
                      border-b border-gray-300
                      bg-gray-100
                      py-3.5
                      px-2
                      backdrop-blur backdrop-filter
                      sm:pr-6
                      lg:pr-8
                    "
                  >
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white">
                <tr v-for="component in components" :key="component.id">
                  <td
                    class="
                      border-b border-gray-200
                      whitespace-nowrap
                      py-4
                      pl-4
                      pr-3
                      text-sm
                      font-medium
                      text-gray-900
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    {{ component.id }}
                  </td>
                  <td
                    class="
                      border-b border-gray-200
                      whitespace-nowrap
                      py-4
                      pl-4
                      pr-3
                      text-sm
                      font-medium
                      text-gray-900
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    {{ component.page }}
                  </td>
                  <td
                    class="
                      border-b border-gray-200
                      whitespace-nowrap
                      py-4
                      pl-4
                      pr-3
                      text-sm
                      font-medium
                      text-gray-900
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    {{ component.team_site }}
                  </td>
                  <td
                    class="
                      border-b border-gray-200
                      whitespace-nowrap
                      py-4
                      pl-4
                      pr-3
                      text-sm
                      font-medium
                      text-gray-900
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    {{ component.team }}
                  </td>
                  <td
                    class="
                      border-b border-gray-200
                      whitespace-nowrap
                      py-4
                      pl-4
                      pr-3
                      text-sm
                      font-medium
                      text-gray-900
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    <div>
                      <a
                        class="underline text-blue-600 hover:blue-900"
                        :href="component.view_path"
                        target="_blank"
                        >View Page in AEM</a
                      >
                    </div>
                    <div>
                      <a
                        class="underline text-blue-600 hover:blue-900"
                        :href="component.edit_path"
                        target="_blank"
                        >Edit Page in AEM</a
                      >
                    </div>
                  </td>

                  <td
                    class="
                      border-b border-gray-200
                      whitespace-nowrap
                      py-4
                      pl-4
                      pr-3
                      text-sm
                      font-medium
                      text-gray-900
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    {{ component.status }}
                  </td>

                  <td
                    class="
                      border-b border-gray-200
                      whitespace-nowrap
                      py-4
                      pl-4
                      pr-3
                      text-sm
                      font-medium
                      text-gray-900
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    {{ component.assigned_to }}
                  </td>
                  <td
                    class="
                      border-b border-gray-200
                      whitespace-nowrap
                      py-4
                      pl-4
                      pr-3
                      text-sm
                      font-medium
                      text-gray-900
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    {{ component.Notes }}
                  </td>
                  <td
                    class="
                      border-b border-gray-200
                      py-4
                      pl-4
                      pr-3
                      text-sm
                      font-medium
                      text-gray-900
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    {{ component.experience_fragment_path }}
                  </td>
                  <td
                    class="
                      border-b border-gray-200
                      whitespace-nowrap
                      py-4
                      pl-4
                      pr-3
                      text-sm
                      font-medium
                      text-gray-900
                      sm:pl-6
                      lg:pl-8
                    "
                  >
                    <button
                      class="text-blue-600 hover:text-blue-900 p-2"
                      @click="editComponent(component)"
                    >
                      Edit
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <component-modal v-if="showModal" :component="activeComponent" />
  </div>
</template>

<script>
import PublicLayout from "../../components/Layouts/PublicLayout";
import ComponentModal from "../../components/Modals/ComponentModal.vue";
export default {
  layout: PublicLayout,
  components: { ComponentModal },
  props: ["components"],
  data() {
    return {
      showModal: false,
      activeComponent: null,
    };
  },
  methods: {
    editComponent(component) {
      this.activeComponent = component;
      this.showModal = true;
    },
  },
};
</script>
