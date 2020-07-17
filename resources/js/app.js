/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
require("vue-multiselect/dist/vue-multiselect.min.css");
import VModal from "vue-js-modal";
import TurboLinks from "turbolinks";
import TurbolinksAdapter from "vue-turbolinks";
import CardContainer from "./components/Card.vue";
import MenuContainer from "./modules/menu/MenuContainer.vue";
import RestoGroup from "./modules/restos/RestoGroup.vue";
import OrderGroup from "./modules/orders/OrderGroup.vue";
import ManageOrder from "./modules/orders/ManageOrders.vue";
import Vue from "vue";

TurboLinks.start();

window.Vue = require("vue");

Vue.use(VModal);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// npm run watch
Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/* global componenet */

Vue.component("card-component", CardContainer);

Vue.component("menu-container", MenuContainer);
Vue.component("resto-group", RestoGroup);
Vue.component("order-group", OrderGroup);
Vue.component("manage-orders", ManageOrder);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.eventBus = new Vue({});

document.addEventListener("turbolinks:load", () => {
    var element = document.getElementById("app");
    if (element != null) {
        const app = new Vue({
            el: element
        });
    }
});
