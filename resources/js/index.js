import * as VueGoogleMaps from "vue2-google-maps";

Nova.booting((Vue, router, store) => {
  Vue.use(VueGoogleMaps, {
    load: {
      key: Nova.config.googleMapsKey,
      libraries: "drawing,geometry",
    },
  });

  Vue.component("index-point-field", require("./components/PointIndexField"));
  Vue.component("detail-point-field", require("./components/PointDetailField"));
  Vue.component("form-point-field", require("./components/PointFormField"));

  Vue.component("index-polygon-field", require("./components/PolygonIndexField"));
  Vue.component("detail-polygon-field", require("./components/PolygonDetailField"));
  Vue.component("form-polygon-field", require("./components/PolygonFormField"));

  Vue.component("index-progress-bar-field", require("./components/ProgressBarIndexField"));
  Vue.component("detail-progress-bar-field", require("./components/ProgressBarDetailField"));
  Vue.component("form-progress-bar-field", require("./components/ProgressBarFormField"));
});
