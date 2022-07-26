<template>
    <div>
        <h2 class="text-xl font-bold border-b border-gray-300">
                Пользователи
        </h2>
        <div class="mt-2">
                <a class="update-button">
                    <button
                        @click.prevent="openUser"
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
                        <span>Пользователь</span>
                    </button>
                </a>
        </div>
        <add-user ref="addUser" @add-user-event="getUsers"></add-user>
        <div v-if="!users.length">
            <img src="/storage/img/load_table.svg" style="margin: 0 auto" />
        </div>
         <table v-else class="w-full mt-4">
            <thead>
                <tr>
                    <th
                        class="px-2 py-4 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Имя
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Логин
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Роль
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Email
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Сервис
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Добавлен
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Последний вход
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        IP
                    </th>
                    <th
                        class="px-2 py-1 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Действия
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr
                    class="hover:bg-gray-200 transition-all duration-400"
                    v-for="user in users"
                    :key="user.id"
                >
                    <td
                        class="px-2 w-40 py-3  text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        <a href="#"
                        v-if="currentUser.id != user.id"
                        @click.prevent=""
                        class="text-blue-600 hover:underline">{{ user.name }}</a>
                        <span v-else class="font-medium">{{ user.name }}</span>
                    </td>
                    <td
                        class="px-2 py-3 font-medium text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ user.login }}
                    </td>
                    <td
                        class="px-2 py-3 text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ user.roles.role_slug }}
                    </td>
                    <td
                        class="px-2 py-3 text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ user.email }}
                    </td>
                    <td
                        class="px-2 py-3 text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ user.services.service_name }}
                    </td>
                    <td
                        class="px-2 py-3 text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ correctDate(user.created_at) }}
                    </td>
                    <td
                        class="px-2 py-3 text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ user.last_login == null ? 'Не заходил' : correctDate(user.last_login)  }}
                    </td>
                    <td
                        class="px-2 py-3 text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        {{ user.last_login_ip == null ? '-' : user.last_login_ip  }}
                    </td>
                    <td
                        class="px-2 py-3 text-sm whitespace-no-wrap border-b border-gray-200"
                    >
                        <div v-if="user.id != 0">
                        <a href="#"
                        v-if="currentUser.id != user.id"
                        class="flex space-x-1 text-blue-600 hover:underline"
                        onclick="confirm('Вы уверены?') || event.stopImmediatePropagation()"
                        @click.prevent="closeUser(user.id)"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            <span>{{ user.blocked == 0 ? 'Заблокировать' : 'Разблокировать' }}</span>
                        </a>
                    </div>
                    </td>
                </tr>
            </tbody>
         </table>
    </div>
</template>
<script>
import useUsers from '../../../composables/admin/users/users'
import useHelpers from '../../../composables/common/common'
import { onMounted, ref } from 'vue'
import AddUser from '../dialogs/AddUser.vue'

export default{
  components: { AddUser },
    setup() {
        const { users, currentUser, getUsers, blockUser } = useUsers();
        const { correctDate } = useHelpers();
        const addUser = ref(null);

        onMounted(() => {
            getUsers();
        });

        const closeUser = async (id) => {
            await blockUser(id);
            await getUsers();
        }

        const openUser = async() => {
            await addUser.value.openModal();
        }

        return {
            users,
            currentUser,
            closeUser,
            openUser,
            addUser,
            getUsers,
            correctDate,
            closeUser,
        }
    },
}
</script>
