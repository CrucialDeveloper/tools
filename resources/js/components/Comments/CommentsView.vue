<template>
  <div class="flex flex-col pb-4">
    <h3 class="mr-4 text-lg">
      Comments
      <!-- <span class="text-sm">({{comments.length}})</span> -->
    </h3>
    <div>
      <div class="flex pb-4 border-b" v-for="comment in comments" :key="comment.id">
        <comment :comment="comment"></comment>
      </div>
    </div>
    <div class="my-auto overflow-y-scroll">
      <content-editor
        v-model="form.body"
        height="75"
        :class="form.errors.errors.body ? 'rounded border-2 border-red':''"
        toolbar="comment"
      ></content-editor>
      <div class="w-full text-right">
        <span
          class="ml-2 font-normal text-red-500"
          v-if="form.errors.errors.body"
        >{{form.errors.errors.body[0]}}</span>
        <button
          class="w-full p-2 mt-2 bg-gray-200 rounded hover:bg-gray-300"
          @click="saveNewComment"
        >Add Comment</button>
      </div>
    </div>
    <div></div>
  </div>
</template>

<script>
import ContentEditor from "../UI/ContentEditor";
import Form from "@johnlowery74/crucial-form";
import Comment from "./Comment";

export default {
  components: { ContentEditor, Comment },
  props: ["comments"],
  data() {
    return {
      form: new Form({
        body: ""
      })
    };
  },
  methods: {
    saveNewComment() {
      let vm = this;
      this.form
        .post(`${window.location.href}/comments`)
        .then(function() {
          // this.form.body = "";
          vm.$inertia.reload({
            preserveScroll: false,
            preserveState: false
          });
        })
        .catch(function(errors) {});
    }
  }
};
</script>