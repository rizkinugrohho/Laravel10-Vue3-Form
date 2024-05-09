//import vue router
import { createRouter, createWebHistory } from "vue-router";

//define a routes
const routes = [
  {
    path: "/",
    name: "bonus.index",
    component: () =>
      import(/* webpackChunkName: "index" */ "../views/bonus/index.vue"),
  },
  {
    path: "/create",
    name: "bonus.create",
    component: () =>
      import(/* webpackChunkName: "create" */ "../views/bonus/create.vue"),
  },
  {
    path: "/edit/:id",
    name: "bonus.edit",
    component: () =>
      import(/* webpackChunkName: "edit" */ "../views/bonus/edit.vue"),
  },
  {
    path: "/show/:id",
    name: "bonus.show",
    component: () =>
      import(/* webpackChunkName: "edit" */ "../views/bonus/show.vue"),
  },
];

//create router
const router = createRouter({
  history: createWebHistory(),
  routes, // <-- routes,
});

export default router;
