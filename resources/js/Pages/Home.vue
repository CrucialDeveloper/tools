<template>
  <div class="container p-8 mx-auto flex items-center justify-between">
    <inertia-link
      href="/aem-groups"
      class="border border-transparent hover:border-blue-500 bg-white p-4 rounded shadow"
    >
      <div class="">
        <h2 class="text-2xl">AEM Groups Generator</h2>
        <p>Generate groups for AEM</p>
      </div>
    </inertia-link>
    <inertia-link
      href="/html-cleaner"
      class="border border-transparent hover:border-blue-500 bg-white p-4 rounded shadow"
    >
      <div>
        <h2 class="text-2xl">HTML Cleaner</h2>
        <p>Clean HTML by removing selected tags</p>
      </div>
    </inertia-link>
    <inertia-link
      href="/image-manipulator"
      class="border border-transparent hover:border-blue-500 bg-white p-4 rounded shadow"
    >
      <div>
        <h2 class="text-2xl">Image Manipulator</h2>
        <p>Crop, resize, and download images using custom or preset sizes</p>
      </div>
    </inertia-link>
  </div>
</template>

<script>
import PublicLayout from "../components/Layouts/PublicLayout";

export default {
  layout: PublicLayout,
};
</script>
