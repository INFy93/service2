<template>
    <div>
        <div class="bg-gray-100 rounded-xl p-3">
            <h2 class="text-xl font-bold border-b border-gray-300">
                Пагинация
            </h2>
            <table class="table-auto mt-1" v-if="settings.pagination">
                <tbody class="text-base">
                    <tr>
                        <td>Включить пагинацию?</td>
                        <td class="px-2 py-1">
                            <div>
                                <input type="checkbox"
                                v-model="settings.pagination.enabled"
                                class="rounded focus:outline-none focus:ring dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400">
                                <span class="px-2">Да</span>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="settings.pagination.enabled">
                        <td>Количество выводимых записей</td>
                        <td><select
                        v-model="settings.pagination.per_page"
                        id="paginate"
                        class="ml-2 h-7 w-16 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                    >
                        <option
                        v-for="(variant, index) in pagination_variants"
                        :key="index"
                        :value="variant"
                        class="border-b border-gray-400">
                            {{ variant }}
                        </option>
                    </select></td>
                    </tr>
                </tbody>
            </table>
            <a href="#"
            @click="savePaginationSettings()"
            class="flex items-start w-36 space-x-1 mt-3 mb-3 bg-green-600 hover:bg-green-700 dark:bg-blue-900 text-base dark:hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                <span>Сохранить</span>
            </a>
        </div>
        <div class="bg-gray-100 rounded-xl p-3 mt-3">
            <h2 class="text-xl font-bold border-b border-gray-300">
                Заказы
            </h2>
            <table class="table-auto mt-1" v-if="settings.orders">
                <tbody class="text-base">
                    <tr>
                        <td>Разрешить пользователям экспорт заказов</td>
                        <td class="px-2 py-1">
                            <div>
                                <input type="checkbox"
                                v-model="settings.orders.users_can_export"
                                class="rounded focus:outline-none focus:ring dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400">
                                <span class="px-2">Да</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Обновлять таблицу каждые</td>
                        <td class="px-2 py-1">
                            <input
                                v-model="settings.orders.refresh_time"
                                type="text"
                                name=""
                                id=""
                                class="w-16 h-7 pl-2 text-sm text-black focus:border-transparent focus:outline-none focus:ring-0"
                /> <span> миллисекунд </span></td>
                    </tr>
                    <tr>
                        <td>Отправлять SMS при закрытии заказа</td>
                        <td class="px-2 py-1">
                            <div>
                                <input type="checkbox"
                                v-model="settings.orders.send_sms"
                                class="rounded focus:outline-none focus:ring dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400">
                                <span class="px-2">Да</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Текст SMS</td>
                        <td class="px-2 py-1">
                            <input
                                v-model="settings.orders.sms_text"
                                type="text"
                                name=""
                                id=""
                                class="w-[35rem] h-7 pl-2 text-sm text-black focus:border-transparent focus:outline-none focus:ring-0"
                /></td>
                    </tr>
                </tbody>
            </table>
            <a href="#" class="flex items-start w-36 space-x-1 mt-3 mb-3 bg-green-600 hover:bg-green-700 dark:bg-blue-900 text-base dark:hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                <span>Сохранить</span>
            </a>
        </div>
    </div>
</template>


<script>
import useSettings from "../../../composables/admin/settings/settings";
import { onMounted } from "vue";
export default {
    setup() {
        const { settings, pagination_variants, getSettings, storePaginationSettings } = useSettings();

        onMounted(() => {
            getSettings();
        })

        const savePaginationSettings = async () => {
            await storePaginationSettings();
            await getSettings();
        }

        return {
            settings,
            pagination_variants,
            getSettings,
            savePaginationSettings
        }
    },
}
</script>
