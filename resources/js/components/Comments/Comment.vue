<template>
  <div class="flex w-full mt-4">
    <div
      class="flex items-center justify-center flex-shrink-0 w-10 h-10 mr-4 rounded bg-gray"
    >{{comment.commenter.first_name[0]}}{{comment.commenter.last_name[0]}}</div>
    <div class="w-full">
      <div class="flex items-start justify-between w-full text-sm">
        <div>
          <span
            class="mr-4 font-bold"
          >{{comment.commenter.first_name}} {{comment.commenter.last_name}}</span>
          <span class="text-gray-500">{{commentDate(comment.created_at)}}</span>
        </div>
        <button
          class="w-4 h-4 text-gray-500 fill-current hover:text-gray-600"
          @click="editing = true"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z" />
          </svg>
        </button>
      </div>
      <div class="mt-2">
        <div class="text-sm" v-html="comment.body" v-if="!editing"></div>
        <div v-if="editing">
          <content-editor
            :default="comment.body"
            v-model="form.body"
            :class="form.errors.errors.body ? 'rounded border-2 border-red':''"
            toolbar="comment"
            height="75"
          ></content-editor>
          <div class="flex items-center justify-between mt-2">
            <div>
              <button class="mr-2 text-gray-500 underline" @click="editing = false">Cancel</button>
              <button class="mr-2 underline text-red" @click="deleteComment">Delete</button>
            </div>
            <div>
              <span
                class="mr-2 font-normal text-red"
                v-if="form.errors.errors.body"
              >{{form.errors.errors.body[0]}}</span>
              <button class="underline" @click="saveComment">Save</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ContentEditor from "../UI/ContentEditor";
import Form from "@johnlowery74/crucial-form";
window.form = Form;
export default {
  components: { ContentEditor },
  props: ["comment"],
  data() {
    return {
      editing: false,
      form: new Form({
        body: this.comment.body
      })
    };
  },
  methods: {
    commentDate(date) {
      return new Date(date);
    },
    saveComment() {
      let vm = this;
      this.form
        .patch(`/comments/${this.comment.url_id}`)
        .then(function(response) {
          vm.$inertia.reload({
            preserveScroll: false,
            preserveState: false
          });
        })
        .catch(function(errors) {
          console.log(errors);
        });
    },
    deleteComment() {
      let vm = this;
      this.form
        .delete(`/comments/${this.comment.url_id}`)
        .then(function(response) {
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