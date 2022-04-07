<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="px-8 max-w-screen overflow-hidden" ref="noscroll">
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
      <div class="mt-4 space-y-4 divide-y-3 xl:divide-y-0 divide-gray-200">
        <div class="grid grid-cols-[100px_100%] gap-4">
          <h4 class="w-24 text-right">Team Site:</h4>
          <div class="flex items-center justify-start space-x-4 width-full">
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

        <div class="grid grid-cols-[100px_1fr] gap-4 pt-4 xl:pt-0">
          <h4 class="w-24 text-right">Team:</h4>
          <div class="grid sm:grid-cols-3 xl:grid-cols-8 gap-x-4 gap-y-2">
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
            <button
              @click="setTeamFilter('benefits-main')"
              class="border border-gray-500 rounded px-4"
              :class="
                teamFilter.includes('benefits-main')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Benefits Main
            </button>
            <button
              @click="setTeamFilter('benefits-hawaii')"
              class="border border-gray-500 rounded px-4"
              :class="
                teamFilter.includes('benefits-hawaii')
                  ? 'bg-blue-500 hover:bg-blue:600 border text-white border-blue-500'
                  : 'border border-gray-500 hover:bg-blue-600 hover:text-white'
              "
            >
              Benefits Hawaii
            </button>
          </div>
        </div>
        <div class="grid grid-cols-[100px_1fr] gap-4 pt-4 xl:pt-0">
          <h4 class="w-24 text-right">Status:</h4>
          <div class="grid sm:grid-cols-3 xl:grid-cols-8 gap-x-4 gap-y-2">
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

        <div class="grid grid-cols-[100px_1fr] gap-4 pt-4 xl:pt-0">
          <h4 class="w-24 text-right">Assigned To:</h4>
          <div class="grid sm:grid-cols-3 xl:grid-cols-8 gap-x-4 gap-y-2">
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

        <div class="grid grid-cols-[100px_100%] pt-4 xl:pt-0">
          <h4 class="w-24 text-right">Keyword:</h4>
          <div class="flex items-center space-x-4 ml-4 w-96">
            <input
              type="text"
              name="keywordFilter"
              id="keywordFilter"
              class="shadow-sm border border-gray-500 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-4"
              placeholder="Search for ..."
              v-model="keywordFilter"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="mt-8 hidden lg:block">
      <table class="min-w-full max-w-full border-separate text-sm" style="border-spacing: 0">
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
                <li v-for="(fragment, index) in component.experience_fragment_path" :key="index">
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
    <div class="mt-8 border-t-2 border-gray-500 block lg:hidden">
      <div
        class="bg-white shadow overflow-hidden sm:rounded-lg mt-4"
        v-for="component in shownComponents"
        :key="component.id"
      >
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6 relative">
          <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
              <dt class="text-sm font-medium text-gray-500">Page</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ startCase(component.page) }}</dd>
            </div>
            <div class="sm:col-span-1">
              <dt class="text-sm font-medium text-gray-500">Team Site</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ component.team_site }}</dd>
            </div>
            <div class="sm:col-span-1">
              <dt class="text-sm font-medium text-gray-500">Team</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ component.team }}</dd>
            </div>

            <div class="sm:col-span-1">
              <dt class="text-sm font-medium text-gray-500">Status</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ component.status }}</dd>
            </div>
            <div class="sm:col-span-1">
              <dt class="text-sm font-medium text-gray-500">Assigned To</dt>
              <dd class="mt-1 text-sm text-gray-900">
                {{ component.assigned_to }}
              </dd>
            </div>
            <div class="sm:col-span-2">
              <dt class="text-sm font-medium text-gray-500">Notes</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ component.notes }}</dd>
            </div>
            <div class="sm:col-span-2">
              <dt class="text-sm font-medium text-gray-500">URLs</dt>
              <dd class="mt-1 text-sm text-gray-900">
                <p>
                  <a
                    class="underline text-blue-500 hover:text-blue-600"
                    :href="component.view_path"
                    >{{ component.view_path }}</a
                  >
                </p>
                <p>
                  <a
                    class="underline text-blue-500 hover:text-blue-600"
                    :href="component.edit_path"
                    >{{ component.edit_path }}</a
                  >
                </p>
              </dd>
            </div>
            <div class="sm:col-span-2">
              <dt class="text-sm font-medium text-gray-500">Fragments</dt>
              <dd class="mt-1 text-sm text-gray-900">
                <p v-for="(fragment, index) in component.experience_fragment_path" :key="index">
                  <a class="underline text-blue-500 hover:bg-blue-600" :href="fragment">
                    {{ fragment }}
                  </a>
                </p>
              </dd>
            </div>
          </dl>
          <button
            class="text-blue-600 hover:text-blue-900 p-2 absolute top-0 right-0"
            @click="editComponent(component)"
          >
            Edit
          </button>
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
import { ref, onMounted, watch } from 'vue'
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
let keywordFilter = ref('')

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

watch(keywordFilter, () => applyFilters())

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

  if (keywordFilter.value.length > 0) {
    shownComponents.value = shownComponents.value.filter((component) => {
      return (
        component.page.toLowerCase().includes(keywordFilter.value.toLowerCase()) ||
        component.notes.toLowerCase().includes(keywordFilter.value.toLowerCase()) ||
        component.view_path.toLowerCase().includes(keywordFilter.value.toLowerCase()) ||
        component.edit_path.toLowerCase().includes(keywordFilter.value.toLowerCase())
      )
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
