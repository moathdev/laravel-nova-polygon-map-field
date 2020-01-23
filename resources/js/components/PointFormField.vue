<template>
  <default-field :errors="errors" :field="field">
    <template slot="field">
      <gmap-map
        :center="value"
        :zoom="12"
        ref="map"
        style="width: 800px; height: 500px"
      >
        <gmap-marker
          :draggable="true"
          :position="value"
          @dragend="handleChange"
          ref="marker"
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
        value: { lat: 24.7267943, lng: 46.8128664 },
      };
    },

    methods: {
      /*
       * Set the initial, internal value for the field.
       */
      setInitialValue() {
        this.$gmapApiPromiseLazy()
          .then(() => {
            const marker = (new Wkt.Wkt()).fromJson(this.field.value).toObject();

            this.updateValue(marker.getPosition());
          });
      },

      /**
       * Fill the given FormData object with the field's internal value.
       */
      fill(formData) {
        const geoJSON = (new Wkt.Wkt()).fromObject(this.$refs.marker.$markerObject).toJson();

        formData.append(this.field.attribute, JSON.stringify(geoJSON));
      },

      /**
       * Update the field's internal value.
       */
      handleChange(value) {
        this.updateValue(value.latLng);
      },

      updateValue(value) {
        this.value = value;
        this.updateMapView(value);
      },

      updateMapView(value) {
        const mapRef = this.$refs.map;

        mapRef.$mapObject.setCenter(value);
      },
    },
  };
</script>
