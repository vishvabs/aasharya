export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    {name:'editme', path: '/AddSuh', component: require('./components/AddSuh.vue').default, props:true},
    { path: '/EditSuh', component: require('./components/EditSuh.vue').default },
    { path: '/ListSuh', component: require('./components/ListSuh.vue').default },
    { path: '/ListInmate', component: require('./components/ListInmate.vue').default },
    { path: '/SuhReport', component: require('./components/SuhReport.vue').default },
    { path: '/InmateReport', component: require('./components/InmateReport.vue').default },
    { path: '/AddAttendance', component: require('./components/AddAttendance.vue').default },
    { path: '/ListAttendance', component: require('./components/ListAttendance.vue').default },
    { name: 'inmateView', path: '/InmateReportView', component: require('./components/InmateReportView.vue').default },
    { name: 'suhView', path: '/SuhReportView', component: require('./components/SuhReportView.vue').default },
    { name: 'AttendanceView', path: '/AttendanceView', component: require('./components/AttendanceView.vue').default },
    {  path: '/AttendanceReport', component: require('./components/AttendanceReport.vue').default },
    {name:'editInmate', path: '/AddInmate', component: require('./components/AddInmate.vue').default, props:true},
    { path: '*', component: require('./components/NotFound.vue').default }
];
