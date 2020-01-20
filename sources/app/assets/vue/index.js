import Vue from "vue";
import App from "./App";
import router from "./router";
import store from "./store";
import Artists from "./views/Artists/list/Artists";
new Vue({
  components: { App, Artists },
  template: "<App/>",
  router,
  store
}).$mount("#app");