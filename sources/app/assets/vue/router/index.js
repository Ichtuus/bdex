import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const router =  new VueRouter({
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
      path: "/admin",
      name: "Admin",
      meta: {
        requiresAuth: true
      },
      component: () => import("../views/Admin/Dashboard"),
    },
    {
      path: "/profile",
      name: "Profile",
      meta: {
        requiresAuth: true
      },
      component: () => import("../views/Admin/Profile/User"),
    },
    {
      path: "*",
      name: "Logout",
      redirect: "/"
    },
    {
      path: "*",
      redirect: "/"
    }
  ]
});

router.beforeEach(function(to, from, next) {
    if (to.meta.requiresAuth) {
      const localStore = JSON.parse(localStorage.getItem('localStore'));
      const isLogged = localStore.login.isAuthenticated;
      if(isLogged) {
        next()
      } else {
        next({
          name: 'Home'
        })
      }
    } else {
      next()
    }
})

export default router;