<template>
  <public-layout>
    <div class="container p-8 mx-auto flex items-center justify-between">
      <Link
        href="/aem-groups"
        class="border border-transparent hover:border-blue-500 bg-white p-4 rounded shadow"
      >
        <div class="">
          <h2 class="text-2xl">AEM Groups Generator</h2>
          <p>Generate groups for AEM</p>
        </div>
      </Link>
      <Link
        href="/html-cleaner"
        class="border border-transparent hover:border-blue-500 bg-white p-4 rounded shadow"
      >
        <div>
          <h2 class="text-2xl">HTML Cleaner</h2>
          <p>Clean HTML by removing selected tags</p>
        </div>
      </Link>
      <Link
        href="/image-manipulator"
        class="border border-transparent hover:border-blue-500 bg-white p-4 rounded shadow"
      >
        <div>
          <h2 class="text-2xl">Image Manipulator</h2>
          <p>Crop, resize, and download images using custom or preset sizes</p>
        </div>
      </Link>
      <Link
        href="/components"
        class="border border-transparent hover:border-blue-500 bg-white p-4 rounded shadow"
      >
        <div>
          <h2 class="text-2xl">Reference Component Migration</h2>
          <p>Tracker the Reference component migration to Experience Fragments</p>
        </div>
      </Link>
    </div>
  </public-layout>
</template>

<script setup>
import PublicLayout from '../components/Layouts/PublicLayout'
import { Link } from '@inertiajs/inertia-vue3'
</script>
