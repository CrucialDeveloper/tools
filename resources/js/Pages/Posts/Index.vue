<template>
  <div class="container p-4 mx-auto">
    <h1 class="mt-8 text-5xl">My Writings</h1>
    <div class="mt-4">
      <content-paginator :items="posts" placeholder="Search Posts ..." v-slot="{filteredItems}">
        <div
          class="flex flex-col mt-8 bg-white rounded shadow-md md:flex-row"
          v-for="post in filteredItems"
          :key="post.id"
        >
          <img src="https://picsum.photos/384/216" alt="placeholder" class="mr-0 rounded md:mr-4" />
          <div class="flex flex-col p-4 my-4">
            <a :href="post.path" class="text-sm cursor-pointer hover:underline">
              <h3 class="text-xl">{{post.title}}</h3>
            </a>
            <p class v-html="post.excerpt"></p>
            <div class="mt-auto">
              <a
                :href="post.path"
                class="text-sm text-blue-500 cursor-pointer hover:underline"
              >Read More ...</a>
            </div>
          </div>
        </div>
      </content-paginator>
    </div>
  </div>
</template>

<script>
import PublicLayout from "../../components/Layouts/PublicLayout";
import ContentPaginator from "../../components/Layouts/ContentPaginator";

export default {
  layout: PublicLayout,
  components: { PublicLayout, ContentPaginator },
  props: ["posts"]
};
</script>