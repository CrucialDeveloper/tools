/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';


import { InertiaApp } from '@inertiajs/inertia-vue'
import VModal from 'vue-js-modal'
import Vue from 'vue'

window.Vue = Vue

Vue.use(InertiaApp)
Vue.use(VModal, { dynamic: true, injectModalsContainer: true })


const app = document.getElementById('app')

new Vue({
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import(`./Pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(app)