/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp } from 'vue';

import Maska from "maska";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import { Field, Form, ErrorMessage } from 'vee-validate';
//toast options
const options = {
    position: "top-right",
    transition: "Vue-Toastification__fade",
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: true,
    closeButton: "button",
    icon: true,
    rtl: false
};
import VueHtmlToPaper from './plugins/VueHtmlToPaper';
const p_options = {
    styles: [
        '/css/printable.css',
      ]
}
import Orders from './components/orders/Orders';
import AddOrder from './components/dialogs/AddOrder';
import EditOrder from './components/dialogs/EditOrder';
import Print from './components/print/Print';
import Profile from './components/profile/Profile';

//dashboard
import AdminPanel from './components/admin/AdminMain';
import OrdersAdmin from './components/admin/orders/OrdersAdmin';
import OrdersCount from './components/admin/orders/OrdersCount';
import ShowOrder from './components/admin/dialogs/OrderInfo'
import UsersAdmin from './components/admin/users/UsersAdmin';
import AddUser from './components/admin/dialogs/AddUser';
import EditUser from './components/admin/dialogs/EditUser';
import Analytics from './components/admin/analytics/Analytics';

import LaravelVuePagination from 'laravel-vue-pagination';
import { Menu, MenuButton, MenuItems, MenuItem, TransitionRoot, TransitionChild, Dialog, DialogTitle, DialogOverlay, TabGroup, TabList, Tab, TabPanels, TabPanel,  RadioGroup, RadioGroupLabel, RadioGroupDescription, RadioGroupOption } from '@headlessui/vue'
import { ChevronDownIcon } from "@heroicons/vue/solid";

const app = createApp({});

//custom components
app.component('orders', Orders);
app.component('add-order', AddOrder);
app.component('edit-order', EditOrder);
app.component('print-order', Print);
app.component('profile', Profile);

app.component('admin-panel', AdminPanel);
app.component('orders-admin', OrdersAdmin);
app.component('orders-count', OrdersCount);
app.component('show-order', ShowOrder);
app.component('users-admin', UsersAdmin);
app.component('add-user', AddUser);
app.component('edit-user', EditUser);
app.component('analytics', Analytics);

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
app.component('DialogTitle', DialogTitle);
app.component('DialogOverlay', DialogOverlay);

//tabs
app.component('TabGroup', TabGroup);
app.component('TabList', TabList);
app.component('Tab', Tab);
app.component('TabPanels', TabPanels);
app.component('TabPanel', TabPanel);

//radio group
app.component('RadioGroup', RadioGroup);
app.component('RadioGroupLabel', RadioGroupLabel);
app.component('RadioGroupDescription', RadioGroupDescription);
app.component('RadioGroupOption', RadioGroupOption);

//form
app.component('Form', Form);
app.component('Field', Field);
app.component('ErrorMessage', ErrorMessage);

//app use some plugins
app.use(Maska);
app.use(Toast, options);
app.use(VueHtmlToPaper, p_options);

app.mount('#app');
