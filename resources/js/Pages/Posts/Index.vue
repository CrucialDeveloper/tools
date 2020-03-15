<template>
  <div class="container p-4 mx-auto">
    <div class="flex items-center justify-between">
      <h1 class="mr-4 text-5xl">My Writings</h1>
      <button
        class="flex items-center justify-center w-10 h-10 text-2xl leading-none text-white bg-blue-500 rounded hover:bg-blue-600"
        @click="openPostModal"
        v-if="$page.user && $page.user.person.permissions.posts.create"
      >
        <span>+</span>
      </button>
    </div>
    <div class="mt-4">
      <content-paginator :items="posts" placeholder="Search Posts ..." v-slot="{filteredItems}">
        <div class="flex flex-col items-center">
          <div
            class="flex flex-col mt-8 bg-white rounded shadow-md md:flex-row md:w-full"
            v-for="post in filteredItems"
            :key="post.id"
          >
            <img
              :src="post.imagePath"
              alt="placeholder"
              class="w-full mr-0 rounded md:mr-4 md:w-128"
            />
            <div class="flex flex-col flex-1 p-4">
              <div class="flex items-center justify-between">
                <inertia-link :href="post.path" class="mr-4 text-sm cursor-pointer hover:underline">
                  <h3 class="text-2xl">{{post.title}}</h3>
                </inertia-link>
                <button
                  class="w-8 h-8 p-1 text-gray-200 border rounded hover:bg-gray-300"
                  @click="openPostModal(post)"
                  v-if="$page.user && $page.user.person.permissions.posts.update"
                >
                  <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <path
                      d="M6 34.5V42h7.5l22.13-22.13-7.5-7.5L6 34.5zm35.41-20.41c.78-.78.78-2.05 0-2.83l-4.67-4.67c-.78-.78-2.05-.78-2.83 0l-3.66 3.66 7.5 7.5 3.66-3.66z"
                    />
                  </svg>
                </button>
              </div>
              <span
                class="text-sm text-gray-300"
              >Posted: {{post.publishedAtString}} by {{post.byline}}</span>
              <p class="mt-4" v-html="post.excerpt"></p>
              <div class="mt-auto">
                <inertia-link
                  :href="post.path"
                  class="text-sm text-blue-500 cursor-pointer hover:underline"
                >Read More ...</inertia-link>
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
    openPostModal(post) {
      if (post.id === undefined) {
        post = null;
      }

      this.$modal.show(
        PostModal,
        { post },
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