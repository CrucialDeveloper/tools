<template>
  <div
    class="fixed z-10 inset-0 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
  >
    <div
      class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
    >
      <!--
                  Background overlay, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
      <div
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        aria-hidden="true"
      ></div>

      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"
        >&#8203;</span
      >

      <!--
                  Modal panel, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->
      <div
        class="relative inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden transform transition-all sm:my-8 sm:align-middle sm:max-w-1/2 sm:w-full sm:p-6"
      >
        <div>
          <div class="mt-3 text-center sm:mt-5 relative">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
              Edit Component/Page Item
            </h3>
            <button class="w-6 h-6 text-gray-500 absolute right-0 top-0" @click="closeModal">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div>
            <p class="mb-4">{{ activeComponent.id }} - {{ startCase(activeComponent.page) }}</p>

            <div
              class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:py-5"
            >
              <label for="status" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Status
              </label>
              <div class="mt-1 sm:mt-0 sm:col-span-2">
                <select
                  id="status"
                  name="status"
                  class="block max-w-lg w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md p-2 border border-gray-100"
                  v-model="activeComponent.status"
                >
                  <option value="Not Started">Not Started</option>
                  <option value="In Progress">In Progress</option>
                  <option value="Need Help">Need Help</option>
                  <option value="No Action Needed">No Action Needed</option>
                  <option value="Completed">Completed</option>
                </select>
              </div>
            </div>
            <div
              class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:py-5"
            >
              <label
                for="assigned_to"
                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
              >
                Assigned To
              </label>
              <div class="mt-1 sm:mt-0 sm:col-span-2">
                <select
                  id="assigned_to"
                  name="assigned_to"
                  class="block max-w-lg w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md p-2 border border-gray-100"
                  v-model="activeComponent.assigned_to"
                >
                  <option value="John Lowery">John Lowery</option>
                  <option value="Monique Peyser">Monique Peyser</option>
                  <option value="Marcy Bursac">Marcy Bursac</option>
                  <option value="Jeff Feuring">Jeff Feuring</option>
                </select>
              </div>
            </div>
            <div
              class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:py-5"
            >
              <label for="notes" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                >Notes</label
              >
              <div class="mt-1 sm:mt-0 sm:col-span-2">
                <textarea
                  id="notes"
                  name="notes"
                  rows="5"
                  class="block max-w-lg w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md p-2 border border-gray-100"
                  placeholder="Enter notes here ..."
                  v-model="activeComponent.notes"
                />
              </div>
            </div>
            <div
              class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-b sm:border-gray-200 sm:py-5"
            >
              <label for="email" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Experience Fragments Path(s)
              </label>
              <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="flex items-center">
                  <input
                    id="experience_fragments"
                    name="experience_fragments"
                    type="experience_fragments"
                    class="block max-w-lg w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md p-2 border border-gray-100"
                    v-model="new_fragment"
                    @enter="addFragment"
                  />
                  <button
                    class="rounded-full h-8 w-8 bg-gray-500 hover:bg-gray-600 text-white ml-4"
                    @click="addFragment"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                      />
                    </svg>
                  </button>
                </div>
                <div class="flex flex-col mt-1">
                  <p v-for="fragment in activeComponent.experience_fragment_path">
                    {{ fragment }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-5 sm:mt-6">
          <button
            type="button"
            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm"
          >
            Go back to dashboard
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { startCase } from 'lodash'

let props = defineProps({
  component: Object,
})
let activeComponent = ref(props.component)
let new_fragment = ref('')

const addFragment = () => {
  if (activeComponent.value.experience_fragment_path === null) {
    activeComponent.value.experience_fragment_path = [new_fragment]
    return
  }
  activeComponent.value.experience_fragment_path.push(new_fragment)
  new_fragment.value = ''
}

const closeModal = () => {
  activeComponent.value = null
  let event = new CustomEvent('close-edit-modal')
  window.dispatchEvent(event)
}
</script>
