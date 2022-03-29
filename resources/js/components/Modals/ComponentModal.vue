<template>
  <!-- This example requires Tailwind CSS v2.0+ -->
  <div
    class="fixed z-10 inset-0 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
  >
    <div
      class="
        flex
        items-end
        justify-center
        min-h-screen
        pt-4
        px-4
        pb-20
        text-center
        sm:block sm:p-0
      "
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
      <span
        class="hidden sm:inline-block sm:align-middle sm:h-screen"
        aria-hidden="true"
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
        class="
          relative
          inline-block
          align-bottom
          bg-white
          rounded-lg
          px-4
          pt-5
          pb-4
          text-left
          overflow-hidden
          shadow-xl
          transform
          transition-all
          sm:my-8 sm:align-middle sm:max-w-1/2 sm:w-full sm:p-6
        "
      >
        <div>
          <div class="mt-3 text-center sm:mt-5">
            <h3
              class="text-lg leading-6 font-medium text-gray-900"
              id="modal-title"
            >
              Edit Component/Page Item
            </h3>
          </div>
          <div class="mt-2">
            <p>{{ activeComponent.id }} - {{ activeComponent.page }}</p>

            <div
              class="
                sm:grid
                sm:grid-cols-3
                sm:gap-4
                sm:items-start
                sm:border-t
                sm:border-gray-200
                sm:pt-5
              "
            >
              <label
                for="country"
                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
              >
                Assigned To
              </label>
              <div class="mt-1 sm:mt-0 sm:col-span-2">
                <select
                  id="country"
                  name="country"
                  autocomplete="country-name"
                  class="
                    max-w-lg
                    block
                    focus:ring-indigo-500 focus:border-indigo-500
                    w-full
                    shadow-sm
                    sm:max-w-xs sm:text-sm
                    border-gray-300
                    rounded-md
                  "
                >
                  <option value="John Lowery">John Lowery</option>
                  <option value="Monique Peyser">Monique Peyser</option>
                  <option value="Marcy Bursac">Marcy Bursac</option>
                  <option value="Jeff Feuring">Jeff Feuring</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-5 sm:mt-6">
          <button
            type="button"
            class="
              inline-flex
              justify-center
              w-full
              rounded-md
              border border-transparent
              shadow-sm
              px-4
              py-2
              bg-blue-600
              text-base
              font-medium
              text-white
              hover:bg-blue-700
              focus:outline-none
              focus:ring-2
              focus:ring-offset-2
              focus:ring-blue-500
              sm:text-sm
            "
          >
            Go back to dashboard
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["component"],
  data() {
    return {
      activeComponent: this.component,
    };
  },
};
</script>
