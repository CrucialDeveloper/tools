<template>
  <div style="width: 100%">
    <iframe
      width="100%"
      height="600"
      :src="address"
      frameborder="0"
      scrolling="no"
      marginheight="0"
      marginwidth="0"
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
        "https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=" +
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
    // this.width = Math.max(300, this.$el.parentNode.clientWidth);
    // this.height = Math.max(400, this.$el.parentNode.clientHeight);
  }
};
</script>