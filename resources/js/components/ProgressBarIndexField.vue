<template>
    <div :style="{ background: 'rgba(208, 208, 208, 0.5)', width: '300px', maxWidth: '100%' }"
         class="rounded-lg progbar"
         style="display: inline-block; height: 16px; clear:both;">
        <div :style="{ background: barColor, width: field.value + '%'}"
             class="rounded-lg progbar"
             style="height: 16px; clear: both;">
        </div>
    </div>
</template>

<script>

  export default {
    props: ["resourceName", "field"],

    computed: {
      barColor: function() {
        if (this.field.value < 10) {
          return "#1f9d55";
        } else if (this.field.value < 20) {
          return "#38c172";
        } else if (this.field.value < 30) {
          return "#51d88a";
        } else if (this.field.value < 40) {
          return "#a2f5bf";
        } else if (this.field.value < 50) {
          return "#faad63";
        } else if (this.field.value <= 60) {
          return "#f6993f";
        } else if (this.field.value <= 70) {
          return "#de751f";
        } else if (this.field.value <= 80) {
          return "#ef5753";
        } else if (this.field.value <= 90) {
          return "#e3342f";
        } else if (this.field.value === 100) {
          return "#cc1f1a";
        }
      },
    },
  };
</script>
