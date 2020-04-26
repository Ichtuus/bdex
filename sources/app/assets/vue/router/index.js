import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

export default new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/",
      name: "Home",
      component: () => import("../views/Home"),

    },
    {
      path: "/artists",
      name: "Artists",
      component: () => import("../views/Artists/list/Artists"),
    },
    {
      path: "/artist/:id",
      name: "artist_show",
      component: () => import("../views/Artists/list/Artist"),
    },
    {
      path: "/groups",
      name: "Groups",
      component: () => import("../views/Groups/list/Groups"),
    },
    {
      path: "*",
      redirect: "/"
    }
  ]
});