/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

// apiURL
window.apiURL = global.apiURL = ((window.location.hostname == "dbp.test") || (window.location.hostname == "test")) ? "https://api.dbp.test/" : "https://api.dbp4.org/";
window.Vue = require('vue');

// Lodash
var _ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['key'] = App.apiParams.key;
window.axios.defaults.headers.common['v'] = App.apiParams.v;


let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
	console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}



// Site
import VueHotkey from 'v-hotkey'
import vSelect from 'vue-select'
Vue.use(VueHotkey)

Vue.component('v-select', vSelect)
Vue.component('tabs', require('./components/bulma/Tabs.vue'))
Vue.component('tab-pane', require('./components/bulma/TabPane.vue'))
Vue.component('pagination', require('./components/bulma/Pagination.vue'))
Vue.component('bulma-accordion', require('./components/bulma/Accordion.vue'))
Vue.component('bulma-accordion-item', require('./components/bulma/AccordionItem.vue'))
Vue.component('form-bible-links', require('./components/FormBibleLinks.vue'))
Vue.component('form-bible-translations', require('./components/FormBibleTranslations.vue'))
Vue.component('form-bible-organizations', require('./components/FormBibleOrganizations.vue'))
Vue.component('form-bible-equivalents', require('./components/FormBibleEquivalents.vue'))
Vue.component('form-bible-books',require('./components/FormBibleBooks.vue'))
Vue.component('task-bible-equivalents', require('./components/Tasks/TaskBibleEquivalents.vue'))

import InstantSearch from 'vue-instantsearch';
Vue.use(InstantSearch);
Vue.component('algolia-bible-search', require('./components/Search/AlgoliaBibleSearch.vue'))
//Vue.component('messages', require('./components/Messages.vue'));
//Vue.component('open-api', require('./components/OpenApi.vue'));
var app = new Vue({
    el: '#app'
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
//import Echo from 'laravel-echo'

import {DataTable} from "simple-datatables"
const myTable = document.querySelector("#myTable");
const dataTable = new DataTable(myTable);