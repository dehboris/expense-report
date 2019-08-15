// const CrimeLogs = () => import(/* webpackChunkName: "crime-logs" */ './components/CrimeLogs.vue');
// const Create = () => import(/* webpackChunkName: "create" */ './components/Create.vue');
// const Edit = () => import(/* webpackChunkName: "edit" */ './components/Edit.vue');
// const Show = () => import(/* webpackChunkName: "show" */ './components/Show.vue');
// const Export = () => import(/* webpackChunkName: "export" */ './components/Export.vue');

export const routes = [
  { path: '', component: CrimeLogs, name: 'All', meta: { type: 'All' } },
  { path: '*', redirect: '' },
];
