<template>
  <div class="container mx-auto">
    <h1 class="mt-8 text-5xl">My Writings</h1>
    <div class="flex mt-8 bg-white rounded shadow" v-for="post in posts" :key="post.id">
      <img src="https://picsum.photos/384/216" alt="placeholder" class="mr-4 rounded" />
      <div class="flex flex-col my-4">
        <h3 class="text-xl">{{post.title}}</h3>
        <p class>{{post.excerpt}}</p>
        <div class="mt-auto">
          <a
            :href="post.path"
            class="text-sm text-blue-500 cursor-pointer hover:underline"
          >Read More ...</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PublicLayout from "../../components/Layouts/PublicLayout";

export default {
  layout: PublicLayout,
  components: { PublicLayout },
  props: ["posts"]
};
</script>