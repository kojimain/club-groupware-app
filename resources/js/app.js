import "./bootstrap.js";

import Vue from "vue";
window.Vue = Vue;

import App from "./App.vue";
import router from "./router";

new Vue({
    el: "#app",
    render: h => h(App),
    router
});
