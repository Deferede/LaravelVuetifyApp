import Vue from 'vue';
import store from './store';
import App from './components/App';
import router from './router'
import vuetify from '../plugins/vuetify'
import settings from "./settings";

/*
Custom components
 */
import CardView from "./components/partials/CardView";
import CardConfirm from "./components/partials/CardConfirm";
import CardEdit from "./components/partials/CardEdit";
import CardCreate from "./components/partials/CardCreate";


require('./bootstrap');

Vue.component('CardView', CardView)
Vue.component('CardCreate', CardCreate)
Vue.component('CardEdit', CardEdit)
Vue.component('CardConfirm', CardConfirm)

Vue.filter('capitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
})

Vue.prototype.$env = settings

const app = new Vue({
    el: '#app',
    router,
    vuetify,
    store,
    strict: settings.appEnv !== 'production',
    components: {App},
    template: '<App/>',
});
