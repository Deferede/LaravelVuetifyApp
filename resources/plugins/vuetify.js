// resources/plugins/vuetify.js

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

let theme = {}

let dark_theme = { dark: true }


const opts = {
    theme: {
        themes: {
            light: {

            },
            dark: {

            },
        },
        dark: localStorage.getItem('app-theme')
    },
}

export default new Vuetify(opts)
