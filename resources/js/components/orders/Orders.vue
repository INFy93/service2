<template>
    <div>
        <div class="flex flex-row items-center mt-2 mb-2">
            <div>
                <a class="flex flex-row space-x-3 update-button">
                    <button @click.prevent="openOrder"
                        class="flex items-center justify-center px-4 py-2 font-bold text-white bg-green-500 rounded-lg hover:bg-green-700 dark:bg-blue-900 dark:hover:bg-blue-700">
                        <span class="hidden bg-yellow-500 bg-blue-500 normal"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Заказ</span>
                    </button>
                    <a class="flex items-center justify-center px-4 py-2 font-bold text-white bg-blue-500 rounded-lg cursor-pointer hover:bg-blue-700 dark:bg-blue-900 dark:hover:bg-blue-700"
                        href="/mac">
                        <span class="hidden bg-yellow-500 bg-blue-500 normal"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        <span class="pl-1">Проверить MAC</span>
                    </a>
                </a>
            </div>
            <div class="flex items-center justify-end ml-auto">
                <div class="w-40 bg-gray-700 rounded-lg cursor-pointer wrapper" :class="{ 'bg-gray-500': showOnlyOpen }"
                    @click="onlyOpen">
                    <div class="flex items-center px-2 py-2 space-x-3 text-white rounded-lg justify-left">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-xl h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="pr-3">
                            <span class="font-medium">{{ openOrdersCount }}
                                {{
                                    declOfNum(openOrdersCount, ["заказ", "заказа", "заказов"])
                                }}</span>
                            <br />
                            <span>{{
                                declOfNum(openOrdersCount, ["открыт", "открыто", "открыто"])
                            }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showOnlyOpen"
            class="flex w-1/3 p-2 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <div>Включено отображение только открытых заказов.</div>
        </div>
        <div class="flex flex-row items-center">
            <div>
                <add-order ref="addOrder" @add-event="updateData"></add-order>
            </div>
            <div>
                <edit-order ref="changeOrder" @update-event="getOrders"></edit-order>
            </div>
            <div v-if="orders.data"
                class="right-0 flex items-center w-full h-10 max-w-xl p-2 mb-2 bg-white border border-gray-200 rounded shadow-sm">
                <svg class="w-5 h-5 text-gray-500 cursor-pointer" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" v-model="search" name="" id="" placeholder="Логин, модель/полная модель, код заказа"
                    class="w-full pl-3 text-sm text-black bg-transparent border-transparent border-none focus:border-transparent focus:outline-none focus:ring-0" />
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
                        leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
                        <MenuItems
                            class="absolute left-0 z-10 w-56 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <div class="px-1 py-1">
                                <MenuItem v-if="!selectPage">
                                <a href="#"
                                    onclick="confirm('Удалить выбранные заказы?') || event.stopImmediatePropagation()"
                                    @click.prevent="deleteOrders"
                                    class="flex px-4 py-2 space-x-1 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span>Удалить</span></a>
                                </MenuItem>
                                <MenuItem>
                                <a :href="url" status_id="2"
                                    class="flex px-4 py-2 space-x-1 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
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
                    {{ declOfNum(checked.length, ["Выбран", "Выбрано", "Выбрано"]) }}
                    <strong>{{ checked.length }}</strong>
                    {{ declOfNum(checked.length, ["заказ", "заказа", "заказов"]) }}
                    (это все, что есть...).
                </div>
                <div class="mb-2" v-else>
                    {{ declOfNum(checked.length, ["Выбран", "Выбрано", "Выбрано"]) }}
                    <strong>{{ checked.length }}</strong>
                    {{ declOfNum(checked.length, ["заказ", "заказа", "заказов"]) }}.
                    Выбрать все <strong>{{ orders.meta.total }}</strong>?
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
                </tr>
            </thead>
            <tbody>
                <tr class="transition-all number hover:bg-gray-200 duration-400" v-for="order in orders.data"
                    :key="order.id" @dblclick="editOrder(order.id)">
                    <td class="w-12 px-2 py-1 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                        <input type="checkbox" :value="order.id" v-model="checked"
                            class="border-gray-300 rounded outline-none focus:outline-none dark:ring-offset-gray-600 dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400" />
                    </td>
                    <td class="w-20 px-2 py-1 text-sm font-medium whitespace-no-wrap border-b border-gray-200">
                        <a href="#" class="text-blue-600 hover:underline" @click.prevent="editOrder(order.id)">
                            {{ order.services.service_code }}-{{ leadingZeros(order.id) }}
                        </a>
                    </td>
                    <td class="px-2 py-1 text-sm whitespace-no-wrap border-b border-gray-200 w-52">
                        <Menu as="div" class="relative inline-block text-left">
                            <div>
                                <MenuButton
                                    class="inline-flex items-center px-4 py-1 text-xs font-medium leading-5 text-white rounded-lg"
                                    :class="'bg-' + order.statuses.color">
                                    {{ order.statuses.name }}
                                    <ChevronDownIcon class="w-5 h-5 ml-2 -mr-1" aria-hidden="true" />
                                </MenuButton>
                            </div>

                            <Transition enter-active-class="transition duration-100 ease-out"
                                enter-from-class="transform scale-95 opacity-0"
                                enter-to-class="transform scale-100 opacity-100"
                                leave-active-class="transition duration-75 ease-in"
                                leave-from-class="transform scale-100 opacity-100"
                                leave-to-class="transform scale-95 opacity-0">
                                <MenuItems
                                    class="absolute left-0 z-10 w-56 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="px-1 py-1">
                                        <MenuItem>
                                        <a @click="changeStatus(1, order.id, order.service)"
                                            class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Новый</a>
                                        </MenuItem>
                                        <MenuItem>
                                        <a @click="changeStatus(2, order.id, order.service)"
                                            class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">В
                                            работе</a>
                                        </MenuItem>
                                    </div>
                                    <div class="px-1 py-1">
                                        <MenuItem>
                                        <a @click="changeStatus(3, order.id, order.service)"
                                            class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">На
                                            согласовании</a>
                                        </MenuItem>
                                        <MenuItem>
                                        <a @click="changeStatus(4, order.id, order.service)"
                                            class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Ждет
                                            запчасть</a>
                                        </MenuItem>
                                    </div>
                                    <div class="px-1 py-1">
                                        <MenuItem>
                                        <a @click="changeStatus(5, order.id, order.service)"
                                            class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Готов</a>
                                        </MenuItem>
                                        <MenuItem>
                                        <a @click="changeStatus(6, order.id, order.service)"
                                            class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Закрыт</a>
                                        </MenuItem>
                                    </div>
                                    <div class="px-1 py-1">
                                        <MenuItem>
                                        <a @click="changeStatus(7, order.id, order.service)"
                                            class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Отказ</a>
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </Transition>
                        </Menu>
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
                                <div class="flex flex-row space-x-1" v-if="order.status != 6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ calcDiff(order.created_at) }}</span>
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
                                    {{ nicePhone(order.client_phone) }}
                                </div>
                            </div>
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
</template>

<script>
import useOrders from "../../composables/orders/orders";
import useHelpers from "../../composables/common/common";
import useSelection from "../../composables/orders/selection_orders";
import { ref, onMounted, watch } from "vue";
export default {
    setup(props, ctx) {
        const addOrder = ref(null);
        const changeOrder = ref(null);
        const url = ref("");

        const {
            orders,
            services,
            user,
            selectedService,
            search,
            showOnlyOpen,
            openOrdersCount,
            getOrders,
            newStatus,
            getServices,
            getOpenOrdersCount,
            onlyOpen,
        } = useOrders();
        const { checked, selectAll, selectPage, iWillHaveOrders, removeOrders } =
            useSelection();
        const { correctDate, calcDiff, leadingZeros, declOfNum, nicePhone } = useHelpers();

        const timer = ref("");

        onMounted(() => {
            getOrders();
            getServices();
            getOpenOrdersCount();
            timer.value = setInterval(function () {
                getOrders(), getOpenOrdersCount();
            }, 300000);
        });

        const openOrder = async () => {
            await addOrder.value.openModal();
        };

        const editOrder = async (id) => {
            await changeOrder.value.openEditDialog(id);
        };

        const updateData = async () => {
            await getOrders();
            await getOpenOrdersCount();
        };

        const changeStatus = async (status_id, order_id, user_service_id) => {
            await newStatus(status_id, order_id, user_service_id);
            await getOrders();
            await getOpenOrdersCount();
        };

        const deleteOrders = async () => {
            await removeOrders();
            await getOrders();
        };

        watch(search, async () => {
            await getOrders();
        });

        watch(selectedService, async () => {
            await getOrders();
            await getOpenOrdersCount();
            selectAll.value = false;
            checked.value = [];
        });

        watch(showOnlyOpen, async () => {
            await getOrders();
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
            url,
            timer,
            user,
            iWillHaveOrders,
            openOrdersCount,
            showOnlyOpen,
            correctDate,
            calcDiff,
            leadingZeros,
            declOfNum,
            nicePhone,
            getOrders,
            deleteOrders,
            getServices,
            changeStatus,
            addOrder,
            openOrder,
            changeOrder,
            editOrder,
            getOpenOrdersCount,
            updateData,
            onlyOpen,
        };
    },
};
</script>
