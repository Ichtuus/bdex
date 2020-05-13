import Vue from "vue";
import App from "./App";
import router from "./router";
import store from "./store";
import axios from 'axios'
import Artists from "./views/Artists/list/Artists";
import Groups from "./views/Groups/list/Groups";
import ArtistsList from "./views/Artists/list/ArtistsList";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

axios.defaults.withCredentials = true;

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.config.productionTip = false

new Vue({
  components: { App },
  template: "<App/>",
  router,
  store
}).$mount("#app");