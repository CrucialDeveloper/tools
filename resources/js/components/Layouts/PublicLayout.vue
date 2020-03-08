<template>
  <div class="h-screen">
    <public-nav></public-nav>
    <slot></slot>
  </div>
</template>

<script>
import PublicNav from "./PublicNav";
export default {
  components: { PublicNav }
};
</script>