<template>
    <div>
        <div class="bg-gray-100 rounded-xl p-3">
            <h2 class="text-xl font-bold border-b border-gray-300">
                Общие сведения
            </h2>
            <orders-count></orders-count>
        </div>
        <div class="bg-gray-100 rounded-xl p-3 mt-3">
            <h2 class="text-xl font-bold border-b border-gray-300">
                Заказы
            </h2>
            <a href="/api/month_export" class="flex items-start w-80 space-x-1 mt-3 mb-3 bg-green-600 hover:bg-green-700 dark:bg-blue-900 text-base dark:hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                </svg>
                <span>Экспорт всех заказов за месяц</span>
        </a>
            <div class="flex flex-row items-center mt-2">
            <div>
                <show-order ref="openOrder"></show-order>
            </div>
            <div
                v-if="orders.data"
                class="bg-white rounded right-0 flex items-center w-full max-w-xl h-10 mb-2 p-2 shadow-sm border border-gray-200"
            >
                <svg
                    class="w-5 text-gray-500 h-5 cursor-pointer"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    ></path>
                </svg>
                <input
                    type="text"
                    v-model="search"
                    name=""
                    id=""
                    placeholder="Логин, модель/полная модель, код заказа"
                    class="w-full pl-3 text-sm text-black border-transparent focus:border-transparent border-none focus:outline-none focus:ring-0 bg-transparent"
                />
            </div>
            <div class="flex items-center justify-center mb-2 ml-3" v-if="orders.data">
                    <input
                            type="checkbox"
                            v-model="showOnlyOpen"
                            class="rounded focus:outline-none outline-none dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400"
                        />
                    <span class="ml-2 text-base mb-1">Только открытые</span>
                </div>
            <div class="mb-2 ml-3" v-if="checked.length">
                <Menu as="div" class="relative inline-block text-left">
                    <div>
                        <MenuButton
                            class="px-4 py-2 inline-flex items-center text-base leading-5 font-semibold rounded-lg text-white bg-gray-700"
                        >
                            С отмеченными ({{ checked.length }}):
                            <ChevronDownIcon
                                class="w-5 h-5 ml-2 -mr-1"
                                aria-hidden="true"
                            />
                        </MenuButton>
                    </div>
                    <transition
                        enter-active-class="transition duration-100 ease-out"
                        enter-from-class="transform scale-95 opacity-0"
                        enter-to-class="transform scale-100 opacity-100"
                        leave-active-class="transition duration-75 ease-in"
                        leave-from-class="transform scale-100 opacity-100"
                        leave-to-class="transform scale-95 opacity-0"
                    >
                        <MenuItems
                            class="absolute z-10 left-0 w-56 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        >
                            <div class="px-1 py-1">
                                <MenuItem v-if="!selectPage">
                                    <a
                                        href="#"
                                        onclick="confirm('Удалить выбранные заказы?') || event.stopImmediatePropagation()"
                                        status_id="1"
                                        @click.prevent="deleteOrders"
                                        class="flex space-x-1 py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            />
                                        </svg>
                                        <span>Удалить</span></a
                                    >
                                </MenuItem>
                                <MenuItem>
                                    <a
                                        :href="url"
                                        status_id="2"
                                        class="flex space-x-1 py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                            />
                                        </svg>
                                        <span>Экспортировать</span></a
                                    >
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
                    }}. Выбрать все <strong>{{ orders.meta.total }}</strong
                    >?
                    <a
                        href="#"
                        @click.prevent="iWillHaveOrders(selectedService)"
                        class="text-blue-600 hover:underline hover:text-blue-700"
                        >Выбрать</a
                    >
                </div>
            </div>
            <div class="flex justify-end items-center mb-2 ml-auto space-x-5">
                    <label
                        for="services"
                        class="block text-m font-medium text-gray-900 dark:text-gray-400"
                        >Сервис</label
                    >
                    <select
                        id="services"
                        v-model="selectedService"
                        class="h-10 w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                        <option value="all" class="border-b border-gray-400">
                            Все сервисы
                        </option>
                        <option
                            v-for="service in services"
                            :key="service.id"
                            :value="service.id"
                            :selected="service.id == selectedService"
                        >
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
                        class="px-2 py-4 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        <input
                            type="checkbox"
                            name=""
                            id=""
                            v-model="selectPage"
                            class="rounded focus:outline-none dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400"
                        />
                    </th>
                    <th
                        class="px-2 py-4 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        №
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Статус
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Создан
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Изделие
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Модель
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Комплектация
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Неисправность
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Клиент
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Сервис
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="number hover:bg-gray-200 transition-all duration-400"
                    v-for="order in orders.data"
                    :key="order.id"
                >
                    <td
                        class="px-2 w-12 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        <input
                            type="checkbox"
                            :value="order.id"
                            v-model="checked"
                            class="rounded focus:outline-none outline-none dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400"
                        />
                    </td>
                    <td
                        class="px-2 w-20 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                         <a
                            href="#"
                            class="text-blue-600 hover:underline"
                            @click.prevent="showOrder(order.id)"
                        >
                            {{ order.services.service_code }}-{{
                                leadingZeros(order.id)
                            }}
                        </a>
                    </td>
                    <td
                        class="px-2 w-52 py-1 text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ order.statuses.name }}
                    </td>
                    <td
                        class="px-2 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        <div class="flex items-center">
                            <div>
                                <div
                                    class="text-sm leading-5 font-medium text-gray-700"
                                >
                                    {{ order.users.name }}
                                </div>
                                <div class="text-sm leading-5 text-gray-500">
                                    {{ correctDate(order.created_at) }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td
                        class="px-2 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ order.product }}
                    </td>
                    <td
                        class="px-2 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        <div>
                                <div
                                    class="text-sm leading-5 font-medium text-gray-700"
                                >
                                    {{ order.model }}
                                </div>
                                <div class="text-sm leading-5 text-gray-500">
                                    {{ order.model_full_name }}
                                </div>
                            </div>
                    </td>
                    <td
                        class="px-2 py-1 text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ order.product_complection }}
                    </td>
                    <td
                        class="px-2 w-96 py-1 text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ order.malfunction }}
                    </td>
                    <td
                        class="px-2 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        <div class="flex items-center">
                            <div>
                                <div
                                    class="text-sm leading-5 font-medium text-gray-700"
                                >
                                    {{ order.client_login }}
                                </div>
                                <div class="text-sm leading-5 text-gray-500">
                                    {{ order.client_phone }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td
                        class="px-2 py-1 text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ order.services.service_name }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            <Pagination
                :data="orders"
                :limit="4"
                @pagination-change-page="getOrders"
                class="mt-4"
            >
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
import { ref, onMounted, watch } from "vue";
export default {
    setup(props, ctx) {
        const openOrder = ref(null);
        const url = ref("");

        const { orders, services, selectedService, search, showOnlyOpen, getOrders, getServices, onlyOpen} = useOrders();
        const { checked, selectAll, selectPage, iWillHaveOrders } = useSelection();
        const { correctDate, leadingZeros, declOfNum } = useHelpers();

        onMounted(() => {
            getOrders();
            getServices();
        });

        const showOrder = async (id) => {
            await openOrder.value.openEditDialog(id);
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
            onlyOpen
        };
    },
};
</script>
