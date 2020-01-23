<template>
  <gmap-map
    :center="position"
    :zoom="12"
    style="width: 200px; height: 150px"
  >
    <gmap-marker :position="position"/>
  </gmap-map>
</template>

<script>
  import Wkt from "wicket/wicket-gmap3";

  export default {
    props: ["resourceName", "field"],

    data() {
      return {
        position: { lat: 0, lng: 0 },
      };
    },

    mounted() {
      this.$gmapApiPromiseLazy().then(() => {
          const marker = (new Wkt.Wkt()).fromJson(this.field.value).toObject();
          this.position = marker.getPosition();
        },
      );
    },
  };
</script>
