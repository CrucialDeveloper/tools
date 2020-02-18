<template>
  <div>
    <div ref="wrapper">
      <textarea :id="id" ref="editor" class="border rounded sun-editor-editable"></textarea>
    </div>
  </div>
</template>



<script>
import plugins from "suneditor/src/plugins";
import suneditor from "suneditor";

export default {
  props: {
    toolbar: {
      type: String
    },
    default: {
      type: String
    },
    height: {
      type: String,
      default: "300px"
    }
  },
  data() {
    return {
      id:
        Math.random()
          .toString(36)
          .substring(2, 15) +
        Math.random()
          .toString(36)
          .substring(2, 15),
      full: [
        [
          "undo",
          "redo",
          "bold",
          "underline",
          "italic",
          "strike",
          "subscript",
          "superscript",
          "removeFormat",
          "fontColor",
          "hiliteColor",
          "indent",
          "outdent",
          "align",
          "horizontalRule",
          "list",
          "table",
          "link",
          "fullScreen",
          "showBlocks",
          "codeView"
        ]
      ],
      simple: [
        [
          "undo",
          "redo",
          "bold",
          "underline",
          "italic",
          "removeFormat",
          "list",
          "link",
          "fullScreen",
          "codeView"
        ]
      ],
      comment: [["undo", "redo", "bold", "underline", "italic", "list", "link"]]
    };
  },
  methods: {
    setToolbar() {
      if (this.toolbar === "simple") {
        return this.simple;
      }
      if (this.toolbar === "full") {
        return this.full;
      }
      if (this.toolbar === "comment") {
        return this.comment;
      }
      return this.full;
    },
    setPastedImageListener: function() {
      this.$refs.wrapper.addEventListener("paste", function(e) {
        var orgEvent = e;
        for (var i = 0; i < orgEvent.clipboardData.items.length; i++) {
          if (
            orgEvent.clipboardData.items[i].kind == "file" &&
            orgEvent.clipboardData.items[i].type == "image/png"
          ) {
            var imageFile = orgEvent.clipboardData.items[i].getAsFile();
            var fileReader = new FileReader();
            fileReader.onloadend = function() {
              window.suneditor.insertHTML(`<img src='${fileReader.result}'>`);
            };
            fileReader.readAsDataURL(imageFile);
            break;
          }
        }
      });
    }
  },
  mounted() {
    window.suneditor = suneditor.create(document.getElementById(this.id), {
      plugins: plugins,
      buttonList: this.setToolbar(),
      width: "100%",
      height: this.height
    });

    window.suneditor.onChange = contents => this.$emit("input", contents);
    if (this.default) {
      window.suneditor.setContents(this.default);
    }
  }
};
</script>
