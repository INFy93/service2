<template>
    <div>
        <div class="p-3 bg-gray-100 rounded-xl">
            <h2 class="text-xl font-bold border-b border-gray-300">
                Общие сведения
            </h2>
            <orders-count></orders-count>
        </div>
        <div class="p-3 mt-3 bg-gray-100 rounded-xl">
            <h2 class="text-xl font-bold border-b border-gray-300">
                Заказы
            </h2>
            <a href="/api/month_export"
                class="flex items-start px-4 py-2 mt-3 mb-3 space-x-1 text-base font-bold text-white bg-green-600 rounded-lg w-80 hover:bg-green-700 dark:bg-blue-900 dark:hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Экспорт всех заказов за месяц</span>
            </a>
            <div class="flex flex-row items-center mt-2">
                <div>
                    <show-order ref="openOrder"></show-order>
                </div>
                <div v-if="orders.data"
                    class="right-0 flex items-center w-full h-10 max-w-xl p-2 mb-2 bg-white border border-gray-200 rounded shadow-sm">
                    <svg class="w-5 h-5 text-gray-500 cursor-pointer" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" v-model="search" name="" id="" placeholder="Логин, модель/полная модель, код заказа"
                        class="w-full pl-3 text-sm text-black bg-transparent border-transparent border-none focus:border-transparent focus:outline-none focus:ring-0" />
                </div>
                <div class="flex items-center justify-center mb-2 ml-3" v-if="orders.data">
                    <input type="checkbox" v-model="showOnlyOpen"
                        class="border-gray-300 rounded outline-none focus:outline-none dark:ring-offset-gray-600 dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400" />
                    <span class="mb-1 ml-2 text-base">Только открытые</span>
                </div>
                <div class="mb-2 ml-3" v-if="checked.length">
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton
                                class="inline-flex items-center px-4 py-2 text-base font-semibold leading-5 text-white bg-gray-700 rounded-lg">
                                С отмеченными ({{ checked.length }}):
                                <ChevronDownIcon class="w-5 h-5 ml-2 -mr-1" aria-hidden="true" />
                            </MenuButton>
                        </div>
                        <transition enter-active-class="transition duration-100 ease-out"
                            enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-in"
                            leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0">
                            <MenuItems
                                class="absolute left-0 z-10 w-56 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="px-1 py-1">
                                    <MenuItem v-if="!selectPage">
                                    <a href="#"
                                        onclick="confirm('Удалить выбранные заказы?') || event.stopImmediatePropagation()"
                                        status_id="1" @click.prevent="deleteOrders"
                                        class="flex px-4 py-2 space-x-1 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Удалить</span></a>
                                    </MenuItem>
                                    <MenuItem>
                                    <a :href="url" status_id="2"
                                        class="flex px-4 py-2 space-x-1 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span>Экспортировать</span></a>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
                <div class="ml-2 text-base" v-if="selectPage">
                    <div class="mb-2" v-if="selectAll">
                        {{
                            declOfNum(checked.length, [
                                "Выбран",
                                "Выбрано",
                                "Выбрано",
                            ])
                        }}
                        <strong>{{ checked.length }}</strong>
                        {{
                            declOfNum(checked.length, [
                                "заказ",
                                "заказа",
                                "заказов",
                            ])
                        }}
                        (это все, что есть...).
                    </div>
                    <div class="mb-2" v-else>
                        {{
                            declOfNum(checked.length, [
                                "Выбран",
                                "Выбрано",
                                "Выбрано",
                            ])
                        }}
                        <strong>{{ checked.length }}</strong>
                        {{
                            declOfNum(checked.length, [
                                "заказ",
                                "заказа",
                                "заказов",
                            ])
                        }}. Выбрать все <strong>{{ orders.meta.total }}</strong>?
                        <a href="#" @click.prevent="iWillHaveOrders(selectedService)"
                            class="text-blue-600 hover:underline hover:text-blue-700">Выбрать</a>
                    </div>
                </div>
                <div class="flex items-center justify-end mb-2 ml-auto space-x-5">
                    <label for="services" class="block font-medium text-gray-900 text-m dark:text-gray-400">Сервис</label>
                    <select id="services" v-model="selectedService"
                        class="h-10 w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="all" class="border-b border-gray-400">
                            Все сервисы
                        </option>
                        <option v-for="service in services" :key="service.id" :value="service.id"
                            :selected="service.id == selectedService">
                            {{ service.service_name }}
                        </option>
                    </select>
                </div>
            </div>
            <div v-if="!orders.data">
                <img src="/storage/img/load_table.svg" style="margin: 0 auto" />
            </div>
            <table v-else class="w-full">
                <thead>
                    <tr>
                        <th
                            class="px-2 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            <input type="checkbox" name="" id="" v-model="selectPage"
                                class="border-gray-300 rounded focus:outline-none dark:ring-offset-gray-600 dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400" />
                        </th>
                        <th
                            class="px-2 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            №
                        </th>
                        <th
                            class="px-2 py-1 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Статус
                        </th>
                        <th
                            class="px-2 py-1 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Создан
                        </th>
                        <th
                            class="px-2 py-1 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Изделие
                        </th>
                        <th
                            class="px-2 py-1 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Модель
                        </th>
                        <th
                            class="px-2 py-1 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Комплектация
                        </th>
                        <th
                            class="px-2 py-1 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Неисправность
                        </th>
                        <th
                            class="px-2 py-1 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Клиент
                        </th>
                        <th
                            class="px-2 py-1 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Сервис
                        </th>
                        <th
                            class="px-2 py-1 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Действия
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="transition-all number hover:bg-gray-200 duration-400" v-for="order in orders.data"
                        :key="order.id">
                        <td class="w-12 px-2 py-1 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                            <input type="checkbox" :value="order.id" v-model="checked"
                                class="border-gray-300 rounded outline-none focus:outline-none dark:ring-offset-gray-600 dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400" />
                        </td>
                        <td class="w-20 px-2 py-1 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                            <a href="#" class="text-blue-600 hover:underline" @click.prevent="showOrder(order.id)">
                                {{ order.services.service_code }}-{{
                                    leadingZeros(order.id)
                                }}
                            </a>
                        </td>
                        <td class="px-2 py-1 text-sm whitespace-no-wrap border-b border-gray-200">
                            {{ order.statuses.name }}
                        </td>
                        <td class="px-2 py-1 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm font-medium leading-5 text-gray-700">
                                        {{ order.users.name }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ correctDate(order.created_at) }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-2 py-1 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                            {{ order.product }}
                        </td>
                        <td class="px-2 py-1 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                            <div>
                                <div class="text-sm font-medium leading-5 text-gray-700">
                                    {{ order.model }}
                                </div>
                                <div class="text-sm leading-5 text-gray-500">
                                    {{ order.model_full_name }}
                                </div>
                            </div>
                        </td>
                        <td class="px-2 py-1 text-sm whitespace-no-wrap border-b border-gray-200">
                            {{ order.product_complection }}
                        </td>
                        <td class="px-2 py-1 text-sm whitespace-no-wrap border-b border-gray-200 w-96">
                            {{ order.malfunction }}
                        </td>
                        <td class="px-2 py-1 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm font-medium leading-5 text-gray-700">
                                        {{ order.client_login }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ order.client_phone }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-2 py-1 text-sm whitespace-no-wrap border-b border-gray-200">
                            {{ order.services.service_name }}
                        </td>
                        <td class="px-2 py-1 text-sm text-gray-700 whitespace-no-wrap border-b border-gray-200">
                            <div class="flex items-center">
                                <a href="#" class="flex space-x-1 text-blue-600 hover:underline">
                                </a>
                                <Menu as="div" class="relative inline-block text-left">
                                    <div>
                                        <MenuButton class="flex space-x-1 text-blue-600 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                            </svg>
                                            <span>Перемещение</span>
                                        </MenuButton>
                                    </div>
                                    <transition enter-active-class="transition duration-100 ease-out"
                                        enter-from-class="transform scale-95 opacity-0"
                                        enter-to-class="transform scale-100 opacity-100"
                                        leave-active-class="transition duration-75 ease-in"
                                        leave-from-class="transform scale-100 opacity-100"
                                        leave-to-class="transform scale-95 opacity-0">
                                        <MenuItems
                                            class="absolute right-0 z-10 w-56 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                            <div class="px-1 py-1">
                                                <MenuItem as="div" v-for="service in services" :key="service.id">
                                                <a v-if="service.id !=
                                                    order.service
                                                    "
                                                    onclick="confirm('Переместить заказ?') || event.stopImmediatePropagation()"
                                                    @click="changeService(order.id, service.id)"
                                                    class="flex px-4 py-2 space-x-1 text-sm text-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                    <span>{{
                                                        service.service_name
                                                    }}</span>
                                                </a>
                                                </MenuItem>
                                            </div>
                                        </MenuItems>
                                    </transition>
                                </Menu>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <Pagination :data="orders" :limit="4" @pagination-change-page="getOrders" class="mt-4">
                    <template #prev-nav>
                        <span>Пред.</span>
                    </template>
                    <template #next-nav>
                        <span>След.</span>
                    </template>
                </Pagination>
            </div>
        </div>
    </div>
</template>
<script>
import useOrders from "../../../composables/orders/orders";
import useHelpers from "../../../composables/common/common";
import useSelection from "../../../composables/orders/selection_orders";
import useAdmin from "../../../composables/admin/orders/admin";
import { ref, onMounted, watch } from "vue";
export default {
    setup(props, ctx) {
        const openOrder = ref(null);
        const url = ref("");

        const { orders, services, selectedService, search, showOnlyOpen, getOrders, getServices, onlyOpen } = useOrders();
        const { checked, selectAll, selectPage, iWillHaveOrders } = useSelection();
        const { correctDate, leadingZeros, declOfNum } = useHelpers();
        const { switchService } = useAdmin();

        onMounted(() => {
            getOrders();
            getServices();
        });

        const showOrder = async (id) => {
            await openOrder.value.openEditDialog(id);
        }

        const changeService = async (order_id, service) => {
            await switchService(order_id, service);
            await getOrders();
        }
        watch(search, async () => {
            await getOrders()
        });

        watch(selectedService, async () => {
            await getOrders();
            selectAll.value = false;
            checked.value = [];

        });

        watch(showOnlyOpen, async () => {
            await getOrders()
        });

        watch(selectPage, async (value) => {
            checked.value = [];
            if (value) {
                orders.value.data.forEach((order) => {
                    checked.value.push(order.id);
                });
            } else {
                checked.value = [];
                selectAll.value = false;
            }
        });

        watch(checked, async () => {
            url.value = "/api/export/" + checked.value;
        });

        return {
            orders,
            search,
            services,
            selectedService,
            selectPage,
            selectAll,
            checked,
            showOrder,
            url,
            iWillHaveOrders,
            showOnlyOpen,
            correctDate,
            leadingZeros,
            declOfNum,
            getOrders,
            getServices,
            openOrder,
            onlyOpen,
            changeService
        };
    },
};
</script>
