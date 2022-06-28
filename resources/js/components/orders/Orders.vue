<template>
    <div>
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
                >
                    <td
                        class="px-2 w-12 py-2 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        <input
                            type="checkbox"
                            :value="order.id"
                            class="rounded focus:outline-none outline-none dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400"
                        />
                    </td>
                    <td
                        class="px-2 w-12 py-2 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ leadingZeros(order.id) }}
                    </td>
                    <td
                        class="px-2 w-12 py-2 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ order.statuses.name }}
                    </td>
                    <td
                        class="px-2 w-12 py-2 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
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
                        class="px-2 w-12 py-2 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ order.model }}
                    </td>
                    <td
                        class="px-2 w-12 py-2 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ order.model_full_name }}
                    </td>
                    <td
                        class="px-2 w-12 py-2 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ order.product_complection }}
                    </td>
                    <td
                        class="px-2 w-12 py-2 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ order.malfunction }}
                    </td>
                    <td
                        class="px-2 w-12 py-2 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
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
import { onMounted } from "vue";

export default {
    setup() {
        const { orders, userService, getOrders } = useOrders();
        const { correctDate, leadingZeros } = useHelpers();
        onMounted(getOrders);

        return {
            orders,
            correctDate,
            leadingZeros,
            getOrders,
        };
    },
};
</script>
