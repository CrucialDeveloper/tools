<template>
  <div class="flex w-full">
    <div
      class="flex items-center justify-center flex-shrink-0 w-12 h-12 mr-8 rounded lg:text-2xl bg-gray"
    >{{comment.commenter.first_name[0]}}{{comment.commenter.last_name[0]}}</div>
    <div class="w-full">
      <div class="flex items-center justify-between w-full">
        <div>
          <span
            class="mr-4 font-bold"
          >{{comment.commenter.first_name}} {{comment.commenter.last_name}}</span>
          <span class="text-gray-500">{{commentDate(comment.created_at)}}</span>
        </div>
        <button
          class="w-4 h-4 text-gray-500 fill-current hover:text-gray-600"
          @click="editing = true"
          v-if="comment.permissions.update"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z" />
          </svg>
        </button>
      </div>
      <div class="mt-2">
        <div class="body" v-html="comment.body" v-if="!editing"></div>
        <div v-if="editing">
          <text-editor
            :default="comment.body"
            v-model="form.body"
            :class="form.errors.errors.body ? 'rounded border-2 border-red':''"
          ></text-editor>
          <div class="flex items-center justify-between mt-2">
            <div>
              <button class="mr-2 underline" @click="editing = false">Cancel</button>
              <button
                class="mr-2 underline text-red"
                @click="deleteComment"
                v-if="comment.permissions.update"
              >Delete</button>
            </div>
            <div>
              <span
                class="mr-2 font-normal text-red"
                v-if="form.errors.errors.body"
              >{{form.errors.errors.body[0]}}</span>
              <button class="bg-white border shadow-none btn" @click="saveComment">Save</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import dateFns from "date-fns";
import TextEditor from "../Inputs/TextEditor";
import Form from "@johnlowery74/crucial-form";
window.form = Form;
export default {
  components: { TextEditor },
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
      return dateFns.format(new Date(date), "ddd, MMMM Do, YYYY h:mm a");
    },
    saveComment() {
      let vm = this;
      this.form
        .patch(`${window.location.href}/comments/${this.comment.id}`)
        .then(function(response) {
          vm.$inertia.reload({
            preserveScroll: true,
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
        .delete(`${window.location.href}/comments/${this.comment.id}`)
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