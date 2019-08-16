// const Buckets = () => import(/* webpackChunkName: "buckets" */ './components/Buckets/Buckets.vue');
// const Bucket = () => import(/* webpackChunkName: "buckets" */ './components/Buckets/ViewBucket.vue');

import Buckets from "./components/Buckets/Buckets";
import Bucket from "./components/Buckets/Bucket";

export const routes = [
  { path: '/', component: Buckets, name: 'buckets' },
  { path: '/buckets/:id', component: Bucket, name: 'buckets.show' },
  { path: '*', redirect: '/' },
];
