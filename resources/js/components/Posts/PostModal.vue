<template>
  <div class="flex flex-col h-full p-4 overflow-y-scroll">
    <h3
      class="mb-4 text-2xl"
    >{{(editPost === undefined || Object.keys(editPost).length ===0)? 'New Post' : 'Edit Post'}}</h3>

    <div class="flex items-center mb-4">
      <label class="w-48 mr-2 text-right" for="title">Title</label>
      <input
        type="text"
        name="title"
        class="w-full p-2 rounded"
        :class="post.errors.has('title') ? 'border border-red-500': 'border'"
        placeholder="Best Post Ever"
        v-model="post.title"
      />
    </div>
    <div class="flex items-start mb-4">
      <label class="w-48 mr-2 text-right" for="address">Excerpt</label>
      <content-editor class="w-full" v-model="post.excerpt" height="175" :default="post.excerpt"></content-editor>
    </div>
    <div class="flex items-start mb-4">
      <label class="w-48 mr-2 text-right" for="address">Body</label>
      <content-editor class="w-full" v-model="post.body" height="175" :default="post.body"></content-editor>
    </div>
    <div class="flex items-center mb-4">
      <label class="w-48 mr-2 text-right" for="byline">Byline</label>
      <input
        type="text"
        name="byline"
        class="w-full p-2 rounded"
        :class="post.errors.has('byline') ? 'border border-red-500': 'border'"
        placeholder="John Doe"
        v-model="post.byline"
      />
    </div>
    <div class="flex items-center mb-4">
      <label class="w-48 mr-2 text-right" for="state">Image Url</label>
      <input
        type="text"
        name="image"
        class="w-full p-2 rounded"
        :class="post.errors.has('image') ? 'border border-red-500': 'border'"
        placeholder="http: ..."
        v-model="post.image"
      />
    </div>
    <div class="flex items-center mb-4">
      <label class="w-48 mr-2 text-right" for="zip">Video Url</label>
      <input
        type="text"
        name="video"
        class="w-full p-2 rounded"
        :class="post.errors.has('video') ? 'border border-red-500': 'border'"
        placeholder="http: ...."
        v-model="post.video"
      />
    </div>
    <div class="flex items-center mb-4">
      <label class="w-48 mr-2 text-right" for="country">Published At</label>
      <div class="w-full">
        <date-picker
          class="p-2"
          :class="post.errors.errors.start_date ? 'border-red border rounded':'border rounded w-full'"
          placeholder="Select Date Post Should Be Public ..."
          v-model="post.start_date"
        ></date-picker>
      </div>
    </div>
    <div class="flex items-center justify-between">
      <div class="flex items-center mr-4">
        <button class="mr-4 text-red-500 underline" @click="deletePost">Delete</button>
      </div>
      <div class="flex items-center">
        <button class="mr-4 text-gray-600 underline" @click="reset">Cancel</button>
        <button
          class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
          @click="savePost"
          v-if="editPost === undefined || Object.keys(editPost).length===0"
        >Save Post</button>
        <button
          class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
          @click="updatePost"
          v-else
        >Save Post</button>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "@johnlowery74/crucial-form";
import ContentEditor from "../UI/ContentEditor";
import DatePicker from "../UI/DatePicker";

export default {
  components: {
    Form,
    ContentEditor,
    DatePicker
  },
  props: ["editPost"],
  data() {
    return {
      post: new Form({
        title: "",
        body: "",
        excerpt: "",
        byline: "",
        image: "",
        video: "",
        published_at: ""
      })
    };
  },
  methods: {
    reset() {
      this.post.reset();
      this.$modal.hide(this.$parent.name);
    },
    savePost() {
      this.post
        .post("/posts", this.post)
        .then(response => {
          this.post.reset();
          this.$modal.hide(this.$parent.name);
          this.$inertia.visit(response);
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    updatePost() {
      this.post
        .patch(this.post.path, this.post)
        .then(response => {
          this.post.reset();
          this.$modal.hide(this.$parent.name);
          this.$inertia.visit(response);
        })
        .catch(errors => {
          console.log(errors);
        });
    },
    deletePost() {
      this.post.delete(this.post.path).then(response => {
        this.post.reset();
        this.$modal.hide(this.$parent.name);
        this.$inertia.visit(response);
      });
    }
  },
  created() {
    if (this.editPost) {
      this.post = new Form({ ...this.editPost });
    }
  }
};
</script>