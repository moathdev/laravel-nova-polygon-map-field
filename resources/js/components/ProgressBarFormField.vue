<template>
    <panel-item :field="field">
        <template slot="value">
            {{field.value}}%
            <div :style="{ background: 'rgba(208, 208, 208, 0.5)', width: '300px'}"
                 class="rounded-lg progbar"
                 style="display: inline-block; height: 16px; clear:both;">
                <div :style="{ background: barColor, width: field.value + '%'}"
                     class="rounded-lg progbar"
                     style="height: 16px; clear: both;">
                </div>
            </div>
        </template>
    </panel-item>
</template>

<script>
  import { FormField, HandlesValidationErrors } from "laravel-nova";

  export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ["resourceName", "resourceId", "field"],

    methods: {
      /*
       * Set the initial, internal value for the field.
       */
      setInitialValue() {
        this.value = this.field.value;
      },

      /**
       * Fill the given FormData object with the field's internal value.
       */
      fill(formData) {
        formData.append(this.field.attribute, JSON.stringify(this.value));
      },

      /**
       * Update the field's internal value.
       */
      handleChange(value) {
        this.value = value;
      },
    },
  };
</script>
