/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import moment from 'moment';
import VCalendar from 'v-calendar';
import {mask} from 'vue-the-mask';
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('calendar-component', require('./components/CalendarComponent.vue').default);
Vue.component('editor-component', require('./components/EditorComponent.vue').default);
Vue.component('input-money-component', require('./components/InputMoneyComponent.vue').default);
Vue.component('campos-credenciamento-component', require('./components/CamposCredenciamento.vue').default);
Vue.component('visitas-salas-component', require('./charts/visitasSalas.vue').default);
Vue.component('files-component', require('./components/FilesComponent.vue').default);
Vue.component('duration-component', require('./components/DurationComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

moment.locale('pt-BR');

Vue.use(VCalendar, {
    // ...some defaults
    screens: {
        tablet: '576px',
        laptop: '992px',
        desktop: '1200px',
    },
    // ...other defaults
});

const app = new Vue({
    el: '#app',
    directives: {mask}
});
