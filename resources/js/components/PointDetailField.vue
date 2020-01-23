<template>
  <panel-item :field="field">
    <template slot="value">
      <gmap-map
        :center="position"
        :zoom="12"
        style="width: 400px; height: 250px"
      >
        <gmap-marker :position="position"/>
      </gmap-map>
    </template>
  </panel-item>
</template>

<script>
  import Wkt from "wicket/wicket-gmap3";

  export default {
    props: ["resource", "resourceName", "resourceId", "field"],

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
