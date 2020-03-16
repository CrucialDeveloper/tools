<template>
  <div id="app" class="w-screen h-screen bg-gray-100">
    <div class="flex items-center p-4">
      <div class="mr-4 bg-white border rounded shadow">
        <input
          type="file"
          name="image"
          @input="getImage($event)"
          accept="image/*"
          class="p-2 text-sm appearance-none"
        />
      </div>
      <div class="flex items-center" v-show="originalResult">
        <div class="p-2 mr-4 bg-white border rounded shadow">
          <label class="mr-2" for>Original Width</label>
          <span class="mr-4">{{originalWidth}}px</span>
          <label class="mr-2" for>Original Height</label>
          <span>{{originalHeight}}px</span>
        </div>

        <div class="flex items-center px-2 py-1 mr-4 bg-white border rounded shadow">
          <label class="mr-2">Select Preset:</label>
          <select
            class="px-4 py-1 bg-white border appearance-none"
            v-model="selectedPreset"
            @change="setCropBoxSize"
            @blur="setCropBoxSize"
          >
            <option :value="name" v-for="(preset, name) in presets" :key="name">
              {{name}}
              {{preset.width}}x{{preset.height}}
            </option>
          </select>
        </div>
        <div
          class="flex items-center px-2 py-1 mr-4 bg-white border rounded shadow"
          v-if="selectedPreset"
        >
          <button @click="reset" class="w-4 h-4 mr-4">
            <svg
              viewBox="0 0 20 20"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
            >
              <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                <g id="icon-shape">
                  <path
                    d="M14.6568542,15.6568542 C13.209139,17.1045695 11.209139,18 9,18 C4.581722,18 1,14.418278 1,10 C1,5.581722 4.581722,2 9,2 C13.418278,2 17,5.581722 17,10 L15,10 C15,6.6862915 12.3137085,4 9,4 C5.6862915,4 3,6.6862915 3,10 C3,13.3137085 5.6862915,16 9,16 C10.6568542,16 12.1568542,15.3284271 13.2426407,14.2426407 L14.6568542,15.6568542 L14.6568542,15.6568542 Z M12,10 L20,10 L16,14 L12,10 L12,10 Z"
                    id="Combined-Shape"
                  />
                </g>
              </g>
            </svg>
          </button>
          <button @click="resize" class="w-4 h-4 mr-4">
            <svg
              viewBox="0 0 20 20"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
            >
              <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                <g id="icon-shape">
                  <path
                    d="M4.20710678,17.2071068 L7,20 L0,20 L0,13 L2.79289322,15.7928932 L7.12132034,11.4644661 L8.53553391,12.8786797 L4.20710678,17.2071068 Z M15.7928932,2.79289322 L13,0 L20,0 L20,7 L17.2071068,4.20710678 L12.8786797,8.53553391 L11.4644661,7.12132034 L15.7928932,2.79289322 Z M15.7928932,17.2071068 L13,20 L20,20 L20,13 L17.2071068,15.7928932 L12.8786797,11.4644661 L11.4644661,12.8786797 L15.7928932,17.2071068 Z M4.20710678,2.79289322 L7,0 L0,0 L0,7 L2.79289322,4.20710678 L7.12132034,8.53553391 L8.53553391,7.12132034 L4.20710678,2.79289322 Z"
                    id="Combined-Shape"
                  />
                </g>
              </g>
            </svg>
          </button>
          <button @click="crop" class="w-4 h-4 mr-4">
            <svg
              viewBox="0 0 20 20"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
            >
              <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                <g id="icon-shape">
                  <path
                    d="M14,16 L14,20 L16,20 L16,16 L20,16 L20,14 L6,14 L6,0 L4,0 L4,4 L0,4 L0,6 L4,6 L4,14.0059397 C4,15.1054862 4.8927712,16 5.99406028,16 L14,16 Z M14,13 L14,6 L7,6 L7,4 L14.0059397,4 C15.1072288,4 16,4.89451376 16,5.99406028 L16,13 L14,13 Z"
                    id="Combined-Shape"
                  />
                </g>
              </g>
            </svg>
          </button>
          <button @click="download" class="w-4 h-4 mr-4">
            <svg
              viewBox="0 0 20 20"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
            >
              <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                <g id="icon-shape">
                  <path
                    d="M13,8 L13,2 L7,2 L7,8 L2,8 L10,16 L18,8 L13,8 Z M0,18 L20,18 L20,20 L0,20 L0,18 Z"
                    id="Combined-Shape"
                  />
                </g>
              </g>
            </svg>
          </button>
          <button
            class="px-2 py-1 text-white bg-blue-500 rounded"
            @click="setCanvasWidth"
          >Match Width</button>
        </div>
        <div class="p-2 bg-white border rounded shadow" v-if="selectedPreset==='Manual'">
          <span class="mr-2">Crop Box Size:</span>
          <span>{{cropboxWidth}}</span>x
          <span>{{cropboxHeight}}</span>
        </div>
      </div>
    </div>

    <div class="m-4">
      <img class="max-w-full" ref="image" src alt />
    </div>
  </div>
</template>

<script>
import Cropper from "cropperjs";
import PublicLayout from "../../components/Layouts/PublicLayout";

export default {
  layout: PublicLayout,
  components: { PublicLayout },
  data() {
    return {
      originalResult: "",
      originalWidth: "",
      originalHeight: "",
      updatedResult: "",
      selectedPreset: "Manual",
      cropboxWidth: "",
      cropboxHeight: "",
      presets: {
        "Primary Hero": {
          width: 606,
          height: 545
        },
        "Secondary Hero": {
          width: 775,
          height: 357
        },
        "Tertiary Hero": {
          width: 357,
          height: 212
        },
        Newscard: {
          width: 398,
          height: 211
        },
        "Hero Image": {
          width: 1280,
          height: 350
        },
        Spotlight: {
          width: 554,
          height: 520
        },
        "Standard Card": {
          width: 398,
          height: 211
        },
        "Small Card": {
          width: 293,
          height: 156
        },
        "Article Large": {
          width: 1280,
          height: 446
        },
        "Article Medium": {
          width: 1129,
          height: 433
        },
        "Article Small": {
          width: 501,
          height: 336
        },
        "Mosaic - Large": {
          width: 612,
          height: 221
        },
        "Mosaic - Medium": {
          width: 368,
          height: 221
        },
        "Mosaic - Small": {
          width: 236,
          height: 211
        },
        Manual: {
          width: 100,
          height: 100
        }
      }
    };
  },
  methods: {
    getImage(e) {
      if (e.target.files[0]) {
        var reader = new FileReader();
        reader.onload = e => {
          this.originalResult = e.target.result;
          this.$refs.image.setAttribute("src", e.target.result);

          var i = new Image();
          let vm = this;
          i.onload = function() {
            vm.originalWidth = i.width;
            vm.originalHeight = i.height;
          };
          i.src = e.target.result;
        };
      }
      reader.readAsDataURL(e.target.files[0]);
      this.$nextTick(function() {
        this.createCropper();
      });
    },
    setCanvasWidth() {
      let vm = this;
      window.cropper.setCanvasData({
        width: vm.presets[vm.selectedPreset].width
      });
    },
    setCropBoxSize() {
      let vm = this;
      window.cropper.crop();
      if (this.selectedPreset === "Manual") {
        window.addEventListener("crop", e => {
          this.presets["Manual"].width = Math.ceil(e.detail.width);
          this.cropboxWidth = Math.ceil(e.detail.width);
          this.presets["Manual"].height = Math.ceil(e.detail.height);
          this.cropboxHeight = Math.ceil(e.detail.height);
        });
      }

      window.cropper.setCropBoxData({
        width: vm.presets[vm.selectedPreset].width,
        height: vm.presets[vm.selectedPreset].height
      });
    },
    reset() {
      window.cropper.replace(this.originalResult);
      this.updatedResult = this.originalResult;
    },
    resize() {
      var img = new Image();
      img.src = this.originalResult;
      var canvas = document.createElement("canvas");
      var width = this.presets[this.selectedPreset].width;
      var height = this.presets[this.selectedPreset].height;

      canvas.width = width;
      canvas.height = height;
      var ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0, width, height);
      let data = canvas.toDataURL();
      window.cropper.replace(data);
    },

    crop() {
      let vm = this;

      let data = window.cropper
        .getCroppedCanvas({
          width: vm.presets[vm.selectedPreset].width,
          height: vm.presets[vm.selectedPreset].height
        })
        .toDataURL();
      this.updatedResult = data;
      window.cropper.replace(data);
      window.cropper.clear();
      window.cropper.disable();
    },
    download() {
      var link = document.createElement("a");
      link.download = "filename.png";
      link.href = this.updatedResult;
      link.click();
    },
    createCropper() {
      let vm = this;
      window.setTimeout(() => {
        window.cropper = new Cropper(vm.$refs.image, {
          viewMode: 1,
          // cropBoxResizable: false,
          autoCrop: true,
          wheelZoomRatio: 0.01,
          // modal: false,
          highlight: false,
          background: false,
          autoCropArea: 0.2
        });
      }, 200);
    }
  },
  created() {
    window.addEventListener("crop", e => {
      this.presets["Manual"].width = Math.ceil(e.detail.width);
      this.cropboxWidth = Math.ceil(e.detail.width);
      this.presets["Manual"].height = Math.ceil(e.detail.height);
      this.cropboxHeight = Math.ceil(e.detail.height);
    });

    document.onpaste = function(event) {
      var items = (event.clipboardData || event.originalEvent.clipboardData)
        .items;
      console.log(JSON.stringify(items)); // will give you the mime types
      for (index in items) {
        var item = items[index];
        if (item.kind === "file") {
          var blob = item.getAsFile();
          var reader = new FileReader();
          reader.onload = function(event) {}; // data url!
          reader.readAsDataURL(blob);
        }
      }
    };
  }
};
</script>