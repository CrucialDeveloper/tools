<template>
  <div class="h-screen">
    <public-nav></public-nav>
    <div class="w-full mt-4">
      <slot></slot>
    </div>
  </div>
</template>

<script>
import PublicNav from './PublicNav'
export default {
  components: { PublicNav },
}
</script>
