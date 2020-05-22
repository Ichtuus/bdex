import Vue from "vue";
import App from "./App";
import router from "./router";
import store from "./store";
import axios from 'axios'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueCookies from 'vue-cookies'
Vue.use(VueCookies)

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