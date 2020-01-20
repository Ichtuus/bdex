import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home";
import Artists from "../views/Artists/list/Artists";

Vue.use(VueRouter);

export default new VueRouter({
  mode: "history",
  routes: [
    { path: "/", component: Home },
    { path: "/artists", component: Artists },
    { path: "*", redirect: "/" }
  ]
});