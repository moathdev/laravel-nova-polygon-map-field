<template>
  <default-field :errors="errors" :field="field">
    <template slot="field">
      <gmap-map
        :center="center"
        :zoom="5"
        ref="map"
        style="width: 800px; height: 500px"
      >
        <gmap-polygon
          :draggable="true"
          :editable="true"
          :paths="value"
          @paths_changed="updateValue"
          ref="polygon"
        />
      </gmap-map>
    </template>
  </default-field>
</template>

<script>
  import { FormField, HandlesValidationErrors } from "laravel-nova";
  import Wkt from "wicket/wicket-gmap3";

  export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ["resourceName", "resourceId", "field"],

    data() {
      return {
        value: [],
      };
    },

    computed: {
      center() {
        return { lat: 24.7267943, lng: 46.8128664 };
      },
    },

    methods: {
      /*
       * Set the initial, internal value for the field.
       */
      setInitialValue() {
        this.$gmapApiPromiseLazy()
          .then(() => {
            const polygon = (new Wkt.Wkt()).fromJson(this.field.value).toObject();

            this.updateValue(polygon.getPaths());
          });
      },

      /**
       * Fill the given FormData object with the field's internal value.
       */
      fill(formData) {
        const geoJSON = (new Wkt.Wkt()).fromObject(this.$refs.polygon.$polygonObject).toJson();
        formData.append(this.field.attribute, JSON.stringify(geoJSON));
      },

      /**
       * Update the field's internal value.
       */
      handleChange(value) {
        this.updateValue(value);
      },

      updateValue(value) {
        this.value = value;
        this.updateBounds(value);
      },

      updateBounds(value) {
        const mapRef = this.$refs.map;

        this.$gmapApiPromiseLazy()
          .then(() => {
            const bounds = new google.maps.LatLngBounds();

            for (let path of value.getArray()) {
              for (let point of path.getArray()) {
                bounds.extend(point);
              }
            }

            mapRef.fitBounds(bounds, 100);
          });
      },
    },
  };
</script>
