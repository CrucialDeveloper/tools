<template>
  <div class="container mx-auto">
    <div class="p-8 text-white bg-gray-900">
      <h2>{{post.title}}</h2>
      <div ref="videoContainer" v-if="post.video">
        <iframe
          style="width:100%;height:100%;"
          :src="post.video"
          frameborder="0"
          webkitAllowFullScreen
          mozallowfullscreen
          allowfullscreen
        ></iframe>
      </div>
    </div>

    <div class="container py-8 mx-auto">
      <!-- <div class="flex flex-wrap items-center pt-1 mt-1 mb-4 text-sm">
        <span class="mr-4">
          <strong>Tags:</strong>
        </span>
        @foreach($post->tags as $tag)
        <span
          class="px-2 my-1 mr-1 rounded bg-blue-lighter"
        >{{$tag->name}}</span>
        @endforeach
      </div>-->
      <div v-html="post.body"></div>
    </div>
  </div>
</template>

<script>
import PublicLayout from "../../components/Layouts/PublicLayout";

export default {
  layout: PublicLayout,
  components: { PublicLayout },
  props: ["post"],
  mounted() {
    this.$refs.videoContainer.style.height =
      window.innerHeight * 0.666666 + "px";
  }
};
</script>