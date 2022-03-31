<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="px-4 mx-24 max-w-screen" ref="noscroll">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto relative">
        <h1 class="text-xl font-semibold text-gray-900">Reference Components Migration</h1>
        <p class="mt-2 text-sm text-gray-700">
          A list of all pages that have a reference or dynamic reference component as content
        </p>
      </div>
    </div>
    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle">
          <div class="shadow-sm ring-1 ring-black ring-opacity-5">
            <table class="min-w-full border-separate text-sm" style="border-spacing: 0">
              <thead class="bg-slate text-white">
                <tr>
                  <th
                    scope="col"
                    class="
                      sticky
                      top-0
                      z-10
                      border-b border-gray-300
                      bg-slate
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-white
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
                      bg-slate
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-white
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
                      bg-slate
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-white
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
                      bg-slate
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-white
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
                      bg-slate
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-white
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
                      bg-slate
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-white
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
                      bg-slate
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-white
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
                      bg-slate
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-white
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
                      bg-slate
                      py-3.5
                      px-2
                      text-left text-sm
                      font-semibold
                      text-white
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
                      bg-slate
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
                      align-top
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
                    {{ component.id }}
                  </td>
                  <td
                    class="
                      align-top
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
                    {{ startCase(component.page) }}
                  </td>
                  <td
                    class="
                      align-top
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
                    {{ component.team_site }}
                  </td>
                  <td
                    class="
                      align-top
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
                    {{ startCase(component.team) }}
                  </td>
                  <td
                    class="
                      align-top
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
                      align-top
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
                    {{ component.status }}
                  </td>

                  <td
                    class="
                      align-top
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
                    {{ component.assigned_to }}
                  </td>
                  <td
                    class="
                      align-top
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
                    {{ component.notes }}
                  </td>
                  <td
                    class="
                      align-top
                      border-b border-gray-200
                      py-4
                      pl-4
                      pr-3
                      text-sm
                      font-medium
                      text-gray-900
                      sm:pl-6
                      lg:pl-8
                      w-96
                    "
                  >
                    <ul>
                      <li
                        v-for="(fragment, index) in component.experience_fragment_path"
                        :key="index"
                      >
                        {{ fragment }}
                      </li>
                    </ul>
                  </td>
                  <td
                    class="
                      align-top
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
import PublicLayout from '@/components/Layouts/PublicLayout'
import { Inertia } from '@inertiajs/inertia'

export default {
  layout: PublicLayout,
}
</script>

<script setup>
import ComponentModal from '@/components/Modals/ComponentModal'
import { ref, onMounted } from 'vue'
import { startCase } from 'lodash'

let props = defineProps({
  components: Object,
})

let showModal = ref(false)
let activeComponent = ref({})
let noscroll = ref(null)

const editComponent = (component) => {
  activeComponent.value = component
  document.body.style.overflow = 'hidden'
  showModal.value = true
}

onMounted(() => {
  window.addEventListener('close-edit-modal', () => {
    showModal.value = false
    document.body.style.overflow = 'auto'
  })
})
</script>
