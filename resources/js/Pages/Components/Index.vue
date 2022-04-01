<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="px-4 mx-24 max-w-screen" ref="noscroll">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto relative">
        <h2 class="text-2xl font-semibold text-gray-900">Reference Components Migration</h2>
        <p class="mt-2 text-sm text-gray-700">
          A list of all pages that have a reference or dynamic reference component as content
        </p>
      </div>
    </div>
    <div class="mt-2 text-sm">
      <h3 class="underline text-base">Filters:</h3>
      <div class="mt-4 space-y-4">
        <div class="flex items-center">
          <h4 class="w-24 text-right">Team Site:</h4>
          <div class="flex items-center space-x-4 ml-4">
            <button
              @click="setTeamSiteFilter('Yes')"
              class="rounded px-4"
              :class="
                teamSiteFilter === 'Yes'
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Yes
            </button>
            <button
              @click="setTeamSiteFilter('No')"
              class="rounded px-4"
              :class="
                teamSiteFilter === 'No'
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border border-blue-500'
                  : 'border-gray-500 border hover:bg-blue-600 hover:text-white'
              "
            >
              No
            </button>
          </div>
        </div>

        <div class="flex items-center">
          <h4 class="w-24 text-right">Team:</h4>
          <div class="flex items-center space-x-4 ml-4">
            <button
              @click="setTeamFilter('spectrum-reach')"
              class="border border-gray-500 rounded px-4"
              :class="
                teamFilter.includes('spectrum-reach')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Spectrum Reach
            </button>
            <button
              @click="setTeamFilter('spectrum-enterprise')"
              class="border border-gray-500 rounded px-4"
              :class="
                teamFilter.includes('spectrum-enterprise')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Spectrum Enterprise
            </button>
            <button
              @click="setTeamFilter('spectrum-networks')"
              class="border border-gray-500 rounded px-4"
              :class="
                teamFilter.includes('spectrum-networks')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Spectrum Networks
            </button>
            <button
              @click="setTeamFilter('product-technology')"
              class="border border-gray-500 rounded px-4"
              :class="
                teamFilter.includes('product-technology')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Product & Technology
            </button>
            <button
              @click="setTeamFilter('finance')"
              class="border border-gray-500 rounded px-4"
              :class="
                teamFilter.includes('finance')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Finance
            </button>
            <button
              @click="setTeamFilter('field-operations')"
              class="border border-gray-500 rounded px-4"
              :class="
                teamFilter.includes('field-operations')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Field Operations
            </button>
          </div>
        </div>
        <div class="flex items-center">
          <h4 class="w-24 text-right">Status:</h4>
          <div class="flex items-center space-x-4 ml-4">
            <button
              @click="setStatusFilter('Not Started')"
              class="border border-gray-500 rounded px-4"
              :class="
                statusFilter.includes('Not Started')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Not Started
            </button>
            <button
              @click="setStatusFilter('In Progress')"
              class="border border-gray-500 rounded px-4"
              :class="
                statusFilter.includes('In Progress')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              In Progress
            </button>
            <button
              @click="setStatusFilter('Need Help')"
              class="border border-gray-500 rounded px-4"
              :class="
                statusFilter.includes('Need Help')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Need Help
            </button>
            <button
              @click="setStatusFilter('No Action Needed')"
              class="border border-gray-500 rounded px-4"
              :class="
                statusFilter.includes('No Action Needed')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              No Action Needed
            </button>
            <button
              @click="setStatusFilter('Completed')"
              class="border border-gray-500 rounded px-4"
              :class="
                statusFilter.includes('Completed')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Completed
            </button>
          </div>
        </div>

        <div class="flex items-center">
          <h4 class="w-24 text-right">Assigned To:</h4>
          <div class="flex items-center space-x-4 ml-4">
            <button
              @click="setAssignedFilter('John Lowery')"
              class="border border-gray-500 rounded px-4"
              :class="
                assignedFilter.includes('John Lowery')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              John Lowery
            </button>
            <button
              @click="setAssignedFilter('Monique Peyser')"
              class="border border-gray-500 rounded px-4"
              :class="
                assignedFilter.includes('Monique Peyser')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Monique Peyser
            </button>
            <button
              @click="setAssignedFilter('Marcy Bursac')"
              class="border border-gray-500 rounded px-4"
              :class="
                assignedFilter.includes('Marcy Bursac')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Marcy Bursac
            </button>
            <button
              @click="setAssignedFilter('Jeff Feuring')"
              class="border border-gray-500 rounded px-4"
              :class="
                assignedFilter.includes('Jeff Feuring')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Jeff Feuring
            </button>
          </div>
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
                      class="sticky top-0 z-10 border-b border-gray-300 bg-slate py-3.5 px-2 text-left text-sm font-semibold text-white backdrop-blur backdrop-filter sm:pl-6 lg:pl-8"
                    ></th>
                    <th
                      scope="col"
                      class="sticky top-0 z-10 border-b border-gray-300 bg-slate py-3.5 px-2 text-left text-sm font-semibold text-white backdrop-blur backdrop-filter sm:pl-6 lg:pl-8 w-64"
                    >
                      Page
                    </th>
                    <th
                      scope="col"
                      class="sticky top-0 z-10 border-b border-gray-300 bg-slate py-3.5 px-2 text-left text-sm font-semibold text-white backdrop-blur backdrop-filter sm:pl-6 lg:pl-8"
                    >
                      Team Site
                    </th>
                    <th
                      scope="col"
                      class="sticky top-0 z-10 border-b border-gray-300 bg-slate py-3.5 px-2 text-left text-sm font-semibold text-white backdrop-blur backdrop-filter sm:pl-6 lg:pl-8"
                    >
                      Team
                    </th>
                    <th
                      scope="col"
                      class="sticky top-0 z-10 border-b border-gray-300 bg-slate py-3.5 px-2 text-left text-sm font-semibold text-white backdrop-blur backdrop-filter sm:pl-6 lg:pl-8"
                    >
                      Urls
                    </th>
                    <th
                      scope="col"
                      class="sticky top-0 z-10 border-b border-gray-300 bg-slate py-3.5 px-2 text-left text-sm font-semibold text-white backdrop-blur backdrop-filter sm:pl-6 lg:pl-8"
                    >
                      Status
                    </th>
                    <th
                      scope="col"
                      class="sticky top-0 z-10 border-b border-gray-300 bg-slate py-3.5 px-2 text-left text-sm font-semibold text-white backdrop-blur backdrop-filter sm:pl-6 lg:pl-8"
                    >
                      Assigned To
                    </th>
                    <th
                      scope="col"
                      class="sticky top-0 z-10 border-b border-gray-300 bg-slate py-3.5 px-2 text-left text-sm font-semibold text-white backdrop-blur backdrop-filter sm:pl-6 lg:pl-8 w-80"
                    >
                      Notes
                    </th>
                    <th
                      scope="col"
                      class="sticky top-0 z-10 border-b border-gray-300 bg-slate py-3.5 px-2 text-left text-sm font-semibold text-white backdrop-blur backdrop-filter sm:pl-6 lg:pl-8"
                    >
                      Fragments
                    </th>
                    <th
                      scope="col"
                      class="sticky top-0 z-10 border-b border-gray-300 bg-slate py-3.5 px-2 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8"
                    >
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                  <tr v-for="component in shownComponents" :key="component.id">
                    <td
                      class="align-top border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
                    >
                      {{ component.id }}
                    </td>
                    <td
                      class="align-top border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
                    >
                      {{ startCase(component.page) }}
                    </td>
                    <td
                      class="align-top border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
                    >
                      {{ component.team_site }}
                    </td>
                    <td
                      class="align-top border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
                    >
                      {{ startCase(component.team) }}
                    </td>
                    <td
                      class="align-top border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
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
                      class="align-top border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
                    >
                      {{ component.status }}
                    </td>

                    <td
                      class="align-top border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
                    >
                      {{ component.assigned_to }}
                    </td>
                    <td
                      class="align-top border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
                    >
                      {{ component.notes }}
                    </td>
                    <td
                      class="align-top border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8 w-96"
                    >
                      <ul>
                        <li
                          v-for="(fragment, index) in component.experience_fragment_path"
                          :key="index"
                        >
                          <a :href="fragment" target="_blank" class="underline text-blue-500">{{
                            fragment
                          }}</a>
                        </li>
                      </ul>
                    </td>
                    <td
                      class="align-top border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
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
  </div>
  <div></div>
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

let shownComponents = ref({ ...props.components })

let showModal = ref(false)
let activeComponent = ref({})
let noscroll = ref(null)
let teamSiteFilter = ref('')
let teamFilter = ref([])
let statusFilter = ref([])
let assignedFilter = ref([])

const editComponent = (component) => {
  activeComponent.value = component
  document.body.style.overflow = 'hidden'
  showModal.value = true
}

const setTeamSiteFilter = (value) => {
  if (teamSiteFilter.value === value) {
    teamSiteFilter.value = ''
    applyFilters()
    return
  }
  teamSiteFilter.value = value

  applyFilters()
}

const setTeamFilter = (team) => {
  if (teamFilter.value.includes(team)) {
    teamFilter.value = teamFilter.value.filter((item) => {
      return item != team
    })
  } else {
    teamFilter.value.push(team)
  }
  applyFilters()
}

const setStatusFilter = (status) => {
  if (statusFilter.value.includes(status)) {
    statusFilter.value = statusFilter.value.filter((item) => {
      return item != status
    })
  } else {
    statusFilter.value.push(status)
  }
  applyFilters()
}

const setAssignedFilter = (name) => {
  if (assignedFilter.value.includes(name)) {
    assignedFilter.value = assignedFilter.value.filter((item) => {
      return item != name
    })
  } else {
    assignedFilter.value.push(name)
  }
  applyFilters()
}

const applyFilters = () => {
  shownComponents.value = props.components
  if (teamSiteFilter.value != '') {
    shownComponents.value = shownComponents.value.filter((component) => {
      return component.team_site === teamSiteFilter.value
    })
  }

  if (teamFilter.value.length > 0) {
    shownComponents.value = shownComponents.value.filter((component) => {
      return teamFilter.value.includes(component.team)
    })
  }

  if (statusFilter.value.length > 0) {
    shownComponents.value = shownComponents.value.filter((component) => {
      return statusFilter.value.includes(component.status)
    })
  }

  if (assignedFilter.value.length > 0) {
    shownComponents.value = shownComponents.value.filter((component) => {
      return assignedFilter.value.includes(component.assigned_to)
    })
  }
}

onMounted(() => {
  window.addEventListener('close-edit-modal', () => {
    showModal.value = false
    document.body.style.overflow = 'auto'
  })
})
</script>
