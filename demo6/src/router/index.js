// Import vue router
import { createRouter, createWebHistory } from 'vue-router';

// Define routes
const routes = [
  {
    path: "/",
    name: "home",
    component: () => import(/* webpackChunkName: "home" */ "../views/home.vue"),
  },
  // Routes for rumahs (house)
  {
    path: "/rumahs",
    name: "rumahs.index",
    component: () =>
      import(/* webpackChunkName: "rumah-index" */ "../views/rumahs/index.vue"),
  },
  {
    path: "/rumahs/create",
    name: "rumahs.create",
    component: () =>
      import(/* webpackChunkName: "rumah-create" */ "../views/rumahs/create.vue"),
  },
  {
    path: "/rumahs/edit/:id",
    name: "rumahs.edit",
    component: () =>
      import(/* webpackChunkName: "rumah-edit" */ "../views/rumahs/edit.vue"),
  },

  // Routes for reviews
  {
    path: "/reviews",
    name: "reviews.index",
    component: () =>
      import(/* webpackChunkName: "reviews-index" */ "../views/reviews/index.vue"),
  },
  {
    path: "/reviews/create",
    name: "reviews.create",
    component: () =>
      import(/* webpackChunkName: "reviews-create" */ "../views/reviews/create.vue"),
  },
  {
    path: "/reviews/edit/:id",
    name: "reviews.edit",
    component: () =>
      import(/* webpackChunkName: "reviews-edit" */ "../views/reviews/edit.vue"),
  },

  // Routes for ratings
  {
    path: "/ratings",
    name: "ratings.index",
    component: () => import(/* webpackChunkName: "ratings-index" */ "../views/ratings/index.vue"),
  }
  ,
  {
    path: "/ratings/create",
    name: "ratings.create",
    component: () =>
      import(/* webpackChunkName: "ratings-create" */ "../views/ratings/create.vue"),
  },
  {
    path: "/ratings/edit/:id",
    name: "ratings.edit",
    component: () =>
      import(/* webpackChunkName: "ratings-edit" */ "../views/ratings/edit.vue"),
  },
];

// Create router
const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;