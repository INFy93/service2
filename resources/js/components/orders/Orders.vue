<template>
    <div>
        <div class="flex flex-row items-center">
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
                    placeholder="Поиск по логину, модели или полной модели."
                    class="w-full pl-3 text-sm text-black border-transparent focus:border-transparent focus:ring-0 bg-transparent"
                />
            </div>
        </div>
        <table class="w-full">
            <thead>
                <tr>
                    <th
                        class="px-2 py-4 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        <input
                            type="checkbox"
                            name=""
                            id=""

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
                >
                    <td
                        class="px-2 w-12 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        <input
                            type="checkbox"
                            :value="order.id"
                            class="rounded focus:outline-none outline-none dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400"
                        />
                    </td>
                    <td
                        class="px-2 w-20 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ leadingZeros(order.id) }}
                    </td>
                    <td
                        class="px-2 w-52 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        <Menu as="div" class="relative inline-block text-left">
                            <div>
                                <MenuButton
                                    class="px-4 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-lg text-white"
                                    :class="'bg-' + order.statuses.color"
                                >
                                    {{ order.statuses.name }}
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
                                        <MenuItem>
                                            <a
                                                href="#"
                                                status_id="1"
                                                @click.stop.prevent
                                                @click="
                                                    changeStatus(1, order.id)
                                                "
                                                class="block py-1 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >Новый</a
                                            >
                                        </MenuItem>
                                        <MenuItem>
                                            <a
                                                href="#"
                                                status_id="2"
                                                @click.stop.prevent
                                                @click="
                                                    changeStatus(2, order.id)
                                                "
                                                class="block py-1 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >В работе</a
                                            >
                                        </MenuItem>
                                    </div>
                                    <div class="px-1 py-1">
                                        <MenuItem>
                                            <a
                                                href="#"
                                                status_id="3"
                                                @click.stop.prevent
                                                @click="
                                                    changeStatus(3, order.id)
                                                "
                                                class="block py-1 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >На согласовании</a
                                            >
                                        </MenuItem>
                                        <MenuItem>
                                            <a
                                                href="#"
                                                ref="status4"
                                                @click.stop.prevent
                                                @click="
                                                    changeStatus(4, order.id)
                                                "
                                                class="block py-1 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >Ждет запчасть</a
                                            >
                                        </MenuItem>
                                    </div>
                                    <div class="px-1 py-1">
                                        <MenuItem>
                                            <a
                                                href="#"
                                                status_id="5"
                                                @click.stop.prevent
                                                @click="
                                                    changeStatus(5, order.id)
                                                "
                                                class="block py-1 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >Готов</a
                                            >
                                        </MenuItem>
                                        <MenuItem>
                                            <a
                                                href="#"
                                                status_id="6"
                                                @click.stop.prevent
                                                @click="
                                                    changeStatus(6, order.id)
                                                "
                                                class="block py-1 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >Закрыт</a
                                            >
                                        </MenuItem>
                                    </div>
                                    <div class="px-1 py-1">
                                        <MenuItem>
                                            <a
                                                href="#"
                                                status_id="7"
                                                @click.stop.prevent
                                                @click="
                                                    changeStatus(7, order.id)
                                                "
                                                class="block py-1 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >Отказ</a
                                            >
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </td>
                    <td
                        class="px-2 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        <div class="flex items-center">
                            <div>
                                <div
                                    class="text-sm leading-5 font-semibold text-gray-700"
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
                                    class="text-sm leading-5 font-semibold text-gray-700"
                                >
                                    {{ order.model }}
                                </div>
                                <div class="text-sm leading-5 text-gray-500">
                                    {{ order.model_full_name }}
                                </div>
                            </div>
                    </td>
                    <td
                        class="px-2 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ order.product_complection }}
                    </td>
                    <td
                        class="px-2 w-96 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ order.malfunction }}
                    </td>
                    <td
                        class="px-2 py-1 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        <div class="flex items-center">
                            <div>
                                <div
                                    class="text-sm leading-5 font-semibold text-gray-700"
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
import { onMounted, watch } from "vue";
export default {
    setup() {
        const { orders, search, getOrders, newStatus } = useOrders();
        const { correctDate, leadingZeros } = useHelpers();
        onMounted(getOrders);
        const changeStatus = async(status_id, order_id) => {
            await newStatus(status_id, order_id);
            await getOrders();
        }

        watch(search, async () => {
            await getOrders()
        });

        return {
            orders,
            search,
            correctDate,
            leadingZeros,
            getOrders,
            changeStatus
        };
    },
};
</script>
