
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//Bootstrap vue
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

//Vue carousel
import VueCarousel from 'vue-carousel';
Vue.use(VueCarousel);

//Font awesome icons
import 'vue-awesome/icons'
import Icon from 'vue-awesome/components/Icon'
Vue.component('v-icon', Icon);

// Google Maps
import * as VueGoogleMaps from 'vue2-google-maps'
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyC1fCqrMwql9KvB_zMJ3FQQQsqqVy-Ywss'
    }
});

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate);

//Pagination
Vue.component('pagination', require('laravel-vue-pagination'));

import VueHorizontalTimeline from 'vue-horizontal-timeline'
Vue.use(VueHorizontalTimeline);

Vue.component('vue-recaptcha', require('vue-recaptcha'));

import CountDown from 'vuejs-countdown'
Vue.use(CountDown);
Vue.component('Countdown', CountDown);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('team', require('./components/team.vue').default);
import Team from "./components/team.vue";
import Agenda from "./components/agenda.vue";
import Contact from "./components/contact.vue";
import Ticker from "./components/ticker.vue";
import HomeTimeline from "./components/home-timeline";
import Count from './components/count.vue'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components:{
        Team,
        Agenda,
        Contact,
        Ticker,
        HomeTimeline,
        CountDown,
        Count
    }
});
