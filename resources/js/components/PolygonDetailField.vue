<template>
  <panel-item :field="field">
    <template slot="value">
      <gmap-map
        :center="defaultCenter"
        :zoom="12"
        ref="map"
        style="width: 400px; height: 250px"
      >
        <gmap-polygon :paths="paths"/>
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
        defaultCenter: { lat: 0, lng: 0 },
        paths: [],
      };
    },

    mounted() {
      const mapRef = this.$refs.map;

      this.$gmapApiPromiseLazy().then(() => {
          const polygon = (new Wkt.Wkt()).fromJson(this.field.value).toObject();

          console.log(polygon.getPaths());

          this.paths = polygon.getPaths();

          const bounds = new google.maps.LatLngBounds();

          for (let path of this.paths.getArray()) {
            for (let point of path.getArray()) {
              bounds.extend(point);
            }
          }

          mapRef.fitBounds(bounds);
        },
      );
    },
  };
</script>
