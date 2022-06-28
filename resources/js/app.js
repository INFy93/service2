/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp } from 'vue';
import Orders from './components/orders/Orders';
import LaravelVuePagination from 'laravel-vue-pagination';

const app = createApp({});
app.component('orders', Orders);
app.component('Pagination', LaravelVuePagination);
app.mount('#app');
