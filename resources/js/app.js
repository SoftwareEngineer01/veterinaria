require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


//Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import Vue from 'vue';
import App from './App.vue';
import router from './router';

//DataTables
import 'datatables.net/js/jquery.dataTables.min.js';
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.css';
import 'datatables.net-bs4/js/dataTables.bootstrap4.js';
import 'datatables.net-buttons/js/dataTables.buttons.js';
import 'datatables.net-buttons/js/buttons.html5.js';
import 'datatables.net-buttons/js/buttons.print.js';
import 'datatables.net-buttons/js/dataTables.buttons.js';
import 'datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js';
import 'datatables.net-buttons-dt/css/buttons.dataTables.min.css';

Vue.use(BootstrapVue);

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
