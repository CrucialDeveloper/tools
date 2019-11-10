<template>
  <div class="shadow rounded-lg overflow-hidden border-none">
    <iframe
      ref="map"
      :width="width"
      :height="height"
      style="position:relative; z-index=0"
      :src="address"
    ></iframe>
  </div>
</template>

<script>
export default {
  props: ["client"],
  data() {
    return {
      width: 0,
      height: 0
    };
  },
  computed: {
    address() {
      return (
        "https://www.google.com/maps/embed/v1/place?key=AIzaSyCeY6Gu_CaKRqesdQZKUxca8YoSB4iZX4g&q=" +
        this.client.address +
        " " +
        this.client.city +
        ", " +
        this.client.state +
        " " +
        this.client.zip
      );
    }
  },
  mounted() {
    this.width = Math.max(300, this.$el.parentNode.clientWidth);
    this.height = Math.max(400, this.$el.parentNode.clientHeight);
  }
};
</script>