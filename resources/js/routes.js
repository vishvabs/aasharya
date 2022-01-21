export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    {name:'editme', path: '/AddSuh', component: require('./components/AddSuh.vue').default, props:true},
   // { name:'editme', component: require('./components/AddSuh.vue').default, props:true },
    { path: '/ListSuh', component: require('./components/ListSuh.vue').default },
    
    { path: '*', component: require('./components/NotFound.vue').default }
];
