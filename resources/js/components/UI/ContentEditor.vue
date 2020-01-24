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
      fullToolbar: [
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
      simpleToolbar: [
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
      ]
    };
  },
  methods: {
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
      buttonList:
        this.toolbar === "simple" ? this.simpleToolbar : this.fullToolbar,
      width: "100%",
      height: "200px"
    });

    window.suneditor.onChange = contents => this.$emit("input", contents);
    if (this.default) {
      window.suneditor.setContents(this.default);
    }
  }
};
</script>
