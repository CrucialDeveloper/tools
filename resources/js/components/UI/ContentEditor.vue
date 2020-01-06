<template>
  <div>
    <div ref="wrapper">
      <textarea :id="id" ref="editor" class="sun-editor-editable"></textarea>
    </div>
  </div>
</template>



<script>
import "suneditor/dist/css/suneditor.min.css";
import plugins from "suneditor/src/plugins";
import suneditor from "suneditor";

export default {
  props: {
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
          .substring(2, 15)
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
      buttonList: [
        ["undo", "redo"],
        ["font", "fontSize", "formatBlock"],
        ["bold", "underline", "italic", "strike", "subscript", "superscript"],
        ["removeFormat"],
        "/",
        ["fontColor", "hiliteColor"],
        ["indent", "outdent"],
        ["align", "horizontalRule", "list", "table"],
        // ["link", "image", "video"],
        ["link"],
        ["fullScreen", "showBlocks", "codeView"]
      ],
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

<style lang="css">
.sun-editor .se-btn-module-border {
  border: none;
}

.sun-editor .se-toolbar {
  padding: none;
}
.sun-editor .se-btn-module-enter {
  display: none;
}

.sun-editor .se-toolbar {
  padding: 0px !important;
}

.sun-editor .se-btn {
  margin: 0px !important;
  height: unset !important;
  line-height: 21px !important;
}

.sun-editor .se-toolbar [class*="se-icon-"]::before {
  line-height: 1.5 !important;
}

.sun-editor [class*="se-icon-"]::before {
  font-size: 12px !important;
}
</style>