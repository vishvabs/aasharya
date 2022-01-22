export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    {name:'editme', path: '/AddSuh', component: require('./components/AddSuh.vue').default, props:true},
    { path: '/ListSuh', component: require('./components/ListSuh.vue').default },
    { path: '/ListInmate', component: require('./components/ListInmate.vue').default },
    { path: '/SuhReport', component: require('./components/SuhReport.vue').default },
    { path: '/InmateReport', component: require('./components/InmateReport.vue').default },
    {name:'editInmate', path: '/AddInmate', component: require('./components/AddInmate.vue').default, props:true},
    { path: '*', component: require('./components/NotFound.vue').default }
];
