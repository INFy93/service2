/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp } from 'vue';

import Maska from "maska";

import Orders from './components/orders/Orders';
import AddOrder from './components/dialogs/AddOrder';

import LaravelVuePagination from 'laravel-vue-pagination';
import { Menu, MenuButton, MenuItems, MenuItem, TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle, DialogOverlay } from '@headlessui/vue'
import { ChevronDownIcon } from "@heroicons/vue/solid";

const app = createApp({});
app.component('orders', Orders);
app.component('add-order', AddOrder);

//pagination
app.component('Pagination', LaravelVuePagination);

//dropdown
app.component('Menu', Menu);
app.component('MenuButton', MenuButton);
app.component('MenuItems', MenuItems);
app.component('MenuItem', MenuItem);
app.component('ChevronDownIcon', ChevronDownIcon);

//dialog
app.component('TransitionRoot', TransitionRoot);
app.component('TransitionChild', TransitionChild);
app.component('Dialog', Dialog);
app.component('DialogPanel', DialogPanel);
app.component('DialogTitle', DialogTitle);
app.component('DialogOverlay', DialogOverlay);

//app use some plugins
app.use(Maska);


app.mount('#app');
