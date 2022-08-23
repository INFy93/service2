<template>
    <div>
        <div class="bg-gray-100 rounded-xl p-3">
            <h2 class="text-xl font-bold border-b border-gray-300">
                Пагинация
            </h2>
            <table class="table-auto mt-1">
                <tbody class="text-base">
                    <tr>
                        <td>Включить пагинацию?</td>
                        <td class="px-2 py-1">
                            <div>
                                <input type="checkbox" class="rounded focus:outline-none focus:ring dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400">
                                <span class="px-2">Да</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Количество выводимых записей</td>
                        <td><select
                        id="paginate"
                        class="ml-2 h-7 w-16 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                    >
                        <option value="15" class="border-b border-gray-400">
                            15
                        </option>
                        <option value="30" class="border-b border-gray-400">
                            30
                        </option>
                        <option value="45" class="border-b border-gray-400">
                            45
                        </option>
                        <option value="60" class="border-b border-gray-400">
                            60
                        </option>
                    </select></td>
                    </tr>
                </tbody>
            </table>
            <a href="#" class="flex items-start w-36 space-x-1 mt-3 mb-3 bg-green-600 hover:bg-green-700 dark:bg-blue-900 text-base dark:hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                <span>Сохранить</span>
            </a>
        </div>
        <div class="bg-gray-100 rounded-xl p-3 mt-3">
            <h2 class="text-xl font-bold border-b border-gray-300">
                Заказы
            </h2>
            <table class="table-auto mt-1">
                <tbody class="text-base">
                    <tr>
                        <td>Разрешить пользователям экспорт заказов</td>
                        <td class="px-2 py-1">
                            <div>
                                <input type="checkbox" class="rounded focus:outline-none focus:ring dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400">
                                <span class="px-2">Да</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Обновлять таблицу каждые</td>
                        <td class="px-2 py-1">
                            <input
                                type="text"
                                name=""
                                id=""
                                placeholder="300000"
                                class="w-16 h-7 pl-2 text-sm text-black focus:border-transparent focus:outline-none focus:ring-0"
                /> <span> миллисекунд </span></td>
                    </tr>
                    <tr>
                        <td>Отправлять SMS при закрытии заказа</td>
                        <td class="px-2 py-1">
                            <div>
                                <input type="checkbox" class="rounded focus:outline-none focus:ring dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400">
                                <span class="px-2">Да</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Текст SMS</td>
                        <td class="px-2 py-1">
                            <input
                                type="text"
                                name=""
                                id=""
                                placeholder="Ваш заказ выполнен! Просим оставить отзыв: crimeastar.net/otziv"
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
