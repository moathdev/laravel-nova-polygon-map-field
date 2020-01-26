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
});
