<template>
  <div class="px-8 py-4 mt-8 bg-white rounded shadow-lg">
    <h3 class="mr-4 text-xl font-bold">
      Comments
      <span class="text-sm">({{comments.length}})</span>
    </h3>
    <div>
      <div>
        <text-editor
          v-model="form.body"
          :height="250"
          :class="form.errors.errors.body ? 'rounded border-2 border-red':''"
        ></text-editor>
        <div class="w-full text-right">
          <span
            class="ml-2 font-normal text-red"
            v-if="form.errors.errors.body"
          >{{form.errors.errors.body[0]}}</span>
          <button class="mt-2 btn btn-gray" @click="saveNewComment">Add Comment</button>
        </div>
      </div>
      <div>
        <div class="flex pb-4 mt-8 border-b" v-for="comment in comments" :key="comment.id">
          <comment :comment="comment"></comment>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import dateFns from "date-fns";
import TextEditor from "../../Shared/Inputs/TextEditor";
import Form from "@johnlowery74/crucial-form";
import Comment from "./Comment";

export default {
  components: { TextEditor, Comment },
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
          vm.$inertia.reload({
            preserveScroll: true,
            preserveState: false
          });
        })
        .catch(function(errors) {});
    }
  }
};
</script>