<template>
  <div>
    <nav @keydown.escape="open = false" class="bg-slate">
      <div class="px-4 max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <h1 class="text-xl text-white">Tools</h1>
            </div>
            <div class="hidden md:block">
              <div class="flex items-baseline ml-10">
                <Link
                  href="/aem-groups"
                  class="px-3 py-2 ml-4 text-sm font-medium text-gray-300 rounded hover:text-white hover:bg-blue-500 focus:outline-none focus:text-white"
                  >AEM Group Generator</Link
                >
                <Link
                  href="/html-cleaner"
                  class="px-3 py-2 ml-4 text-sm font-medium text-gray-300 rounded hover:text-white hover:bg-blue-500 focus:outline-none focus:text-white"
                  >HTML Cleaner</Link
                >
                <Link
                  href="/image-manipulator"
                  class="px-3 py-2 ml-4 text-sm font-medium text-gray-300 rounded hover:text-white hover:bg-blue-500 focus:outline-none focus:text-white"
                  >Image Manipulation</Link
                >
                <Link
                  href="components"
                  class="px-3 py-2 ml-4 text-sm font-medium text-gray-300 rounded hover:text-white hover:bg-blue-500 focus:outline-none focus:text-white"
                  >Component Migration</Link
                >
              </div>
            </div>
          </div>
          <!-- <div class="hidden md:block">
            <div class="flex items-center ml-4 md:ml-6">
              <button
                class="p-1 text-gray-400 border-2 border-transparent rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700"
              >
                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                  />
                </svg>
              </button>
              <div class="relative ml-3">
                <div>
                  <button
                    @click="open = !open"
                    class="flex items-center max-w-xs text-sm text-white rounded-full focus:outline-none focus:shadow-solid"
                  >
                    <img
                      class="w-8 h-8 rounded-full"
                      src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                      alt
                    />
                  </button>
                </div>
                <div
                  v-show="open"
                  class="absolute right-0 w-48 mt-2 origin-top-right rounded shadow-lg"
                >
                  <div class="py-1 bg-white rounded shadow-xs">
                    <a
                      href="#"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >Your Profile</a>
                    <a
                      href="#"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >Settings</a>
                    <a
                      href="#"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >Sign out</a>
                  </div>
                </div>
              </div>
            </div>
          </div>-->
          <div class="flex -mr-2 md:hidden">
            <button
              @click="open = !open"
              class="inline-flex items-center justify-center p-2 text-gray-400 rounded hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white"
            >
              <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path
                  :class="{ hidden: open, 'inline-flex': !open }"
                  class="inline-flex"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                  :class="{ hidden: !open, 'inline-flex': open }"
                  class="hidden"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
      <div :class="{ block: open, hidden: !open }" class="md:hidden">
        <div class="px-2 pt-2 pb-3 sm:px-3">
          <a
            href="/blog"
            class="block px-3 py-2 mt-1 text-base font-medium rounded hover:text-white hover:bg-blue-500 focus:outline-none focus:text-white"
            :class="isUrl('blog') ? 'text-white' : 'text-gray-300'"
            >Blog</a
          >
          <a
            href="/html-cleaner"
            class="block px-3 py-2 mt-1 text-base font-medium rounded hover:text-white hover:bg-blue-500 focus:outline-none focus:text-white"
            :class="isUrl('html-cleaner') ? 'text-white' : 'text-gray-300'"
            >HTML Cleaner</a
          >
          <a
            href="#"
            class="block px-3 py-2 mt-1 text-base font-medium rounded hover:text-white hover:bg-blue-500 focus:outline-none focus:text-white"
            :class="isUrl('gists') ? 'text-white' : 'text-gray-300'"
            >Gists</a
          >
          <a
            href="image-manipulator"
            class="block px-3 py-2 mt-1 text-base font-medium rounded hover:text-white hover:bg-blue-500 focus:outline-none focus:text-white"
            :class="isUrl('image-manipulator') ? 'text-white' : 'text-gray-300'"
            >Image Manipulator</a
          >
        </div>
        <!-- <div class="pt-4 pb-3 border-t border-gray-700">
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <img
                class="w-10 h-10 rounded-full"
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                alt
              />
            </div>
            <div class="ml-3">
              <div class="text-base font-medium leading-none text-white">Tom Cook</div>
              <div class="mt-1 text-sm font-medium leading-none text-gray-400">tom@example.com</div>
            </div>
          </div>
          <div class="px-2 mt-3">
            <a
              href="#"
              class="block px-3 py-2 text-base font-medium text-gray-400 rounded hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white"
            >Your Profile</a>
            <a
              href="#"
              class="block px-3 py-2 mt-1 text-base font-medium text-gray-400 rounded hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
            >Settings</a>
            <a
              href="#"
              class="block px-3 py-2 mt-1 text-base font-medium text-gray-400 rounded hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
            >Sign out</a>
          </div>
        </div>-->
      </div>
    </nav>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { ref } from 'vue'

let open = ref(false)
const isUrl = (str) => {
  return window.location.href.includes(str)
}
</script>
