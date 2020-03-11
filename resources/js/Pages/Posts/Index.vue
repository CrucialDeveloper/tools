<template>
  <div class="container p-4 mx-auto">
    <div class="flex items-center justify-between">
      <h1 class="mr-4 text-5xl">My Writings</h1>
      <button
        class="flex items-center justify-center w-10 h-10 text-2xl leading-none text-white bg-blue-500 rounded"
        @click="openCreatePostModal"
        v-if="$page.user && $page.user.person.permissions.posts.create"
      >
        <span>+</span>
      </button>
    </div>
    <div class="mt-4">
      <content-paginator :items="posts" placeholder="Search Posts ..." v-slot="{filteredItems}">
        <div class="flex flex-col items-center">
          <div
            class="flex flex-col w-2/3 mt-8 bg-white rounded shadow-md md:flex-row md:w-full min-w-88"
            v-for="post in filteredItems"
            :key="post.id"
          >
            <img :src="post.image" alt="placeholder" class="mr-0 rounded md:mr-4" />
            <div class="flex flex-col flex-1 p-4">
              <a :href="post.path" class="text-sm cursor-pointer hover:underline">
                <h3 class="text-2xl">{{post.title}}</h3>
              </a>
              <span class="text-sm text-gray-300">Posted: {{post.published_at}} by {{post.byline}}</span>
              <p class="mt-4" v-html="post.excerpt"></p>
              <div class="mt-auto">
                <a
                  :href="post.path"
                  class="text-sm text-blue-500 cursor-pointer hover:underline"
                >Read More ...</a>
              </div>
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
import PostModal from "../../components/Posts/PostModal";

export default {
  layout: PublicLayout,
  components: { PublicLayout, ContentPaginator, PostModal },
  props: ["posts"],
  methods: {
    openCreatePostModal() {
      this.$modal.show(
        PostModal,
        {},
        {
          height: "85%",
          width: "1000px",
          minHeight: 800,
          minWidth: 400,
          scrollable: true,
          resizable: true
        }
      );
    }
  }
};
</script>