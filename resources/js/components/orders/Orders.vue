<template>
    <div>
        <div class="mb-2 mt-2 flex flex-row items-center">
            <div>
                <a class="update-button">
                    <button
                        @click.prevent="openOrder"
                        class="flex items-center justify-center bg-green-500 hover:bg-green-700 dark:bg-blue-900 dark:hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                            />
                        </svg>
                        <span>Заказ</span>
                    </button>
                </a>
            </div>
            <div class="flex justify-end items-center ml-auto">
                <div class="wrapper w-40 bg-gray-700 rounded-lg cursor-pointer" :class="{'bg-gray-500': showOnlyOpen}" @click="onlyOpen">
                    <div  class="flex text-white rounded-lg py-2 px-2 space-x-3 justify-left  items-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-xl" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                    </div>
                        <div class="pr-3">
                            <span class="font-medium">{{ openOrdersCount }} {{ declOfNum(openOrdersCount, ['заказ', 'заказа', 'заказов']) }}</span>
                            <br>
                            <span>{{ declOfNum(openOrdersCount, ['открыт', 'открыто', 'открыто']) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-if="showOnlyOpen"
            class="flex p-2 mb-4 w-1/3 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
            role="alert"
        >
            <svg
                class="inline flex-shrink-0 mr-3 w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"
                ></path>
            </svg>
            <div>
                Включено отображение
                только открытых заказов.
            </div>
        </div>
        <div class="flex flex-row items-center">
            <div>
                <add-order ref="addOrder" @add-event="updateData"></add-order>
            </div>
            <div>
                <edit-order ref="changeOrder" @update-event="getOrders"></edit-order>
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
                </tr>
            </thead>
            <tbody>
                <tr
                    class="number hover:bg-gray-200 transition-all duration-400"
                    v-for="order in orders.data"
                    :key="order.id"
                    @dblclick="editOrder(order.id)"
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
                            @click.prevent="editOrder(order.id)"
                        >
                            {{ order.services.service_code }}-{{
                                leadingZeros(order.id)
                            }}
                        </a>
                    </td>
                    <td
                        class="px-2 w-52 py-1 text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        <Menu as="div" class="relative inline-block text-left">
                            <div>
                                <MenuButton
                                    class="px-4 py-1 inline-flex items-center text-xs leading-5 font-medium rounded-lg text-white"
                                    :class="'bg-' + order.statuses.color"
                                >
                                    {{ order.statuses.name }}
                                    <ChevronDownIcon
                                        class="w-5 h-5 ml-2 -mr-1"
                                        aria-hidden="true"
                                    />
                                </MenuButton>
                            </div>

                            <Transition
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
                                        <MenuItem>
                                            <a

                                                @click="
                                                    changeStatus(1, order.id)
                                                "
                                                class="cursor-pointer block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >Новый</a
                                            >
                                        </MenuItem>
                                        <MenuItem>
                                            <a
                                                @click="
                                                    changeStatus(2, order.id)
                                                "
                                                class="cursor-pointer block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >В работе</a
                                            >
                                        </MenuItem>
                                    </div>
                                    <div class="px-1 py-1">
                                        <MenuItem>
                                            <a
                                                @click="
                                                    changeStatus(3, order.id)
                                                "
                                                class="cursor-pointer block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >На согласовании</a
                                            >
                                        </MenuItem>
                                        <MenuItem>
                                            <a
                                                @click="
                                                    changeStatus(4, order.id)
                                                "
                                                class="cursor-pointer block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >Ждет запчасть</a
                                            >
                                        </MenuItem>
                                    </div>
                                    <div class="px-1 py-1">
                                        <MenuItem>
                                            <a
                                                @click="
                                                    changeStatus(5, order.id)
                                                "
                                                class="cursor-pointer block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >Готов</a
                                            >
                                        </MenuItem>
                                        <MenuItem>
                                            <a
                                                @click="
                                                    changeStatus(6, order.id)
                                                "
                                                class="cursor-pointer block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >Закрыт</a
                                            >
                                        </MenuItem>
                                    </div>
                                    <div class="px-1 py-1">
                                        <MenuItem>
                                            <a
                                                @click="
                                                    changeStatus(7, order.id)
                                                "
                                                class="cursor-pointer block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >Отказ</a
                                            >
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </Transition>
                        </Menu>
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

        const { orders, services, selectedService, search, showOnlyOpen, openOrdersCount, getOrders, newStatus, getServices, getOpenOrdersCount, onlyOpen} = useOrders();
        const { checked, selectAll, selectPage, iWillHaveOrders } = useSelection();
        const { correctDate, leadingZeros, declOfNum } = useHelpers();

        onMounted(() => {
            getOrders();
            getServices();
            getOpenOrdersCount();
        });

        const openOrder = async () => {
            await addOrder.value.openModal();
        }

        const editOrder = async (id) => {
            await changeOrder.value.openEditDialog(id);
        }

        const updateData = async () =>
        {
            await getOrders();
            await getOpenOrdersCount();
        }

        const changeStatus = async(status_id, order_id) => {
            await newStatus(status_id, order_id);
            await getOrders();
            await getOpenOrdersCount();
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
            url,
            iWillHaveOrders,
            openOrdersCount,
            showOnlyOpen,
            correctDate,
            leadingZeros,
            declOfNum,
            getOrders,
            getServices,
            changeStatus,
            addOrder,
            openOrder,
            changeOrder,
            editOrder,
            getOpenOrdersCount,
            updateData,
            onlyOpen
        };
    },
};
</script>
