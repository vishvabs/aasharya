export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/AddSuh', component: require('./components/AddSuh.vue').default },
    { path: '/ListSuh', component: require('./components/ListSuh.vue').default },
    
    { path: '*', component: require('./components/NotFound.vue').default }
];
