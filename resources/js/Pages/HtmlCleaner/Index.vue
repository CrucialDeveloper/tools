<template>
  <div id="app" class="m-8 bg-gray-100">
    <div class="flex items-center">
      <button
        class="px-4 py-2 mr-4 text-white bg-blue-500 rounded shadow"
        @click="clean()"
      >
        <span>Clean It!</span>
      </button>
      <button
        class="px-4 py-2 mr-4 text-white bg-blue-500 rounded shadow"
        @click="copy()"
      >
        <span>Copy to Clipboard</span>
      </button>
      <button
        class="px-4 py-2 mr-4 text-white bg-blue-500 rounded shadow"
        @click="reset()"
      >
        <span>Reset Form</span>
      </button>
    </div>

    <div class="flex items-start justify-around mt-8">
      <div class="flex flex-col items-start w-1/2 mr-8">
        <label class="mb-2 font-bold">Original HTML:</label>
        <textarea
          ref="original"
          rows="15"
          class="w-full p-4 shadow"
          v-model="html.original"
        ></textarea>
      </div>
      <div class="flex flex-col items-start w-1/2">
        <label class="mb-2 font-bold">Updated HTML:</label>
        <textarea
          ref="cleaned"
          rows="15"
          class="w-full p-4 shadow"
          readonly
          v-model="html.cleaned"
        ></textarea>
      </div>
    </div>

    <div class="mt-4">
      <div class="flex items-center mb-4">
        <label class="mr-2 font-bold">Tags:</label>
        <input
          type="text"
          class="w-full p-2 bg-white rounded shadow"
          v-model="html.tags"
        />
      </div>
      <div class="flex items-center">
        <label class="mr-2 font-bold">Attributes:</label>
        <input
          type="text"
          class="w-full p-2 bg-white rounded shadow"
          v-model="html.attributes"
        />
      </div>
    </div>
  </div>
</template>

<script>
import PublicLayout from "../../components/Layouts/PublicLayout";

export default {
  layout: PublicLayout,
  data() {
    return {
      html: {
        original: "",
        cleaned: "",
        tags:
          "<p><sub><sup><font><b><strong><i><em><u><a><ul><ol><li><pre><hr><img><table><tr><td><th><h1><h2><h3><h4><h5><a><thead><br><div><button><span>",
        attributes:
          "cellpadding,href,size,color,src,target,rel,colspan,rowspan,style,id,align,class",
      },
    };
  },
  methods: {
    clean: function () {
      let vm = this;
      axios
        .post("/html-cleaner", {
          original: this.html.original,
          tags: this.html.tags,
          attributes: this.html.attributes,
        })
        .then(function (response) {
          vm.html.cleaned = response.data;
        })
        .catch(function (error) {});
    },
    copy() {
      var copyText = this.$refs.cleaned;
      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/
      document.execCommand("copy");
      window.getSelection().removeAllRanges();
    },
    reset() {
      this.html.reset();
    },
  },
};
</script>
