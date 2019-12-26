<template>
  <div class="shadow rounded-lg overflow-hidden border-none w-full">
    <iframe ref="map" width="100%" height="400" style="position:relative; z-index=0" :src="address"></iframe>
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
      let address =
        this.client.address != null ? this.client.address + "%20" : "";
      let city = this.client.city != null ? this.client.city + "%2C%20" : "";
      let state = this.client.state != null ? this.client.state + "%20" : "";
      let zip = this.client.zip != null ? this.client.zip + "%20" : "";
      let country = this.client.country != null ? this.client.country : "";
      // return "https://maps.google.com/maps?q=stamford%2C%20CT%20USA&output=embed";
      return (
        "https://maps.google.com/maps?q=" +
        address +
        city +
        state +
        country +
        "&output=embed"
      );
    }
  },
  mounted() {
    this.width = Math.max(300, this.$el.parentNode.clientWidth);
    this.height = Math.max(400, this.$el.parentNode.clientHeight);
  }
};
</script>

// <div style="width: 100%"><iframe width="100%" height="600" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=stamford%2C%20ct+()&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/coordinates.html">gps coordinates</a></iframe></div><br />