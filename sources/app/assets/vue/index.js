import Vue from "vue";
import App from "./App";
import router from "./router";
import store from "./store";
import Artists from "./views/Artists/list/Artists";
import Groups from "./views/Groups/list/Groups";
import ArtistsList from "./views/Artists/list/ArtistsList";


new Vue({
  components: { App, Artists, ArtistsList, Groups },
  template: "<App/>",
  router,
  store
}).$mount("#app");