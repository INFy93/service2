 <template>
 <TransitionRoot appear :show="isOpen" as="template">
            <Dialog as="div" @close="closeModal">
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="min-h-screen px-4 text-center">
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <DialogOverlay
                                class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0"
                            />
                        </TransitionChild>

                        <span
                            class="inline-block h-screen align-middle"
                            aria-hidden="true"
                        >
                            &#8203;
                        </span>

                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <div
                                class="inline-block w-full max-w-screen-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl"
                            >
                                <div
                                    class="flex justify-between items-start mb-2 rounded-t border-b dark:border-gray-600"
                                >
                                    <DialogTitle
                                        as="h2"
                                        class="text-xl font-medium leading-6 text-gray-900"
                                    >
                                        Добавить пользователя
                                    </DialogTitle>
                                </div>
                              <Form class="mt-6" @submit="addUser" :validation-schema="schema">
                                    <div class="mb-6">
                                        <label
                                            for="user_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >Имя пользователя*</label
                                        >
                                        <Field
                                            type="text"
                                            v-model="userData.userName"
                                            name="user_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Имя и фамилия"
                                            required
                                        />
                                        <ErrorMessage name="user_name" class="text-sm text-red-500" />
                                 </div>
                                    <div class="mb-6">
                                        <label
                                            for="user_login"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >Логин*</label
                                        >
                                        <Field
                                            v-model="userData.userLogin"
                                            name="user_login"
                                            required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Логин пользователя"
                                        />
                                        <ErrorMessage name="user_login" class="text-sm text-red-500" />
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            for="user_email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >E-mail*</label
                                        >
                                        <Field
                                            type="email"
                                            v-model="userData.userEmail"
                                            name="user_email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="E-mail пользователя"
                                            required
                                        />
                                        <ErrorMessage name="user_email" class="text-sm text-red-500" />
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            for="user_pass"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >Пароль*</label
                                        >
                                        <Field
                                            type="password"
                                            v-model="userData.userPass"
                                            name="user_pass"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            required
                                        />
                                        <ErrorMessage name="user_pass" class="text-sm text-red-500" />
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            for="user_pass_confirm"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >Подтверждение пароля*</label
                                        >
                                        <Field
                                            type="password"
                                            v-model="userData.userConfirmPass"
                                            name="user_pass_confirm"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            required
                                        />
                                        <ErrorMessage name="user_pass_confirm" class="text-sm text-red-500" />
                                    </div>
                                    <div class="mb-4">
                                        <label
                                            for="services"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >Сервис</label
                                        >
                                        <select
                                            id="services"
                                            v-model="userData.userService"
                                            class="h-10 w-44 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <option
                                                v-for="service in services"
                                                :key="service.id"
                                                :value="service.id"
                                                :selected="service.id == userData.userService"
                                            >
                                                {{ service.service_name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-4 border-t">
                                        <div class="mt-3">
                                            <input type="checkbox" v-model="userData.userIsAdmin" class="rounded focus:outline-none focus:ring dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400">
                                            <span class="px-2">Администратор</span>
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <div>
                                            <input type="checkbox" class="rounded focus:outline-none focus:ring dark:ring-offset-gray-600 dark:focus:ring-gray-500 border-gray-300 dark:border-gray-600 dark:bg-gray-500 dark:text-gray-400">
                                            <span class="px-2">Может получать уведомления на почту (пока еще заглушка)</span>
                                        </div>

                                    </div>
                                     <div class="mt-4 flex space-x-4 float-right">
                                    <button
                                        type="button"
                                        class="inline-flex justify-items-end px-4 py-2 text-sm font-medium text-blue-900 bg-red-300 border border-transparent rounded-md hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                                        @click="closeModal"
                                    >
                                        Закрыть
                                    </button>
                                    <button
                                        class="inline-flex justify-end px-4 py-2 text-sm font-medium text-blue-900 bg-blue-300 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                                    >
                                        Добавить
                                    </button>
                                </div>
                                </Form>
                            </div>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
</template>
<script>
import useUsers from '../../../composables/admin/users/users';
import useDialogs from "../../../composables/dialogs/dialogs";
import useOrders from "../../../composables/orders/orders";
import { onMounted } from 'vue';
import * as Yup from 'yup';
export default {
   setup(props, { emit }) {
        const { isOpen, openModal, closeModal } = useDialogs();
        const { services, getServices } = useOrders();
        const { userData, createUser } = useUsers();
        const openUserDialog = () => {
            openModal();
        }

        onMounted(() => {
            getServices();
        });

        const addUser = async() => {
            await createUser();
            emit("add-user-event");
            closeModal();
        }

        const schema = Yup.object({
            user_name: Yup.string().required("Необходимо заполнить поле"),
            user_login: Yup.string().required("Необходимо заполнить поле"),
            user_email: Yup.string().required("Необходимо ввести e-mail").email("Проверьте правильность ввода e-mail"),
            user_pass: Yup.string().required("Необходимо заполить поле").min(8, "Длина пароля должна быть не менее 8 символов"),
            user_pass_confirm: Yup.string().required("Необходимо заполнить поле").min(8, "Длина пароля должна быть не менее 8 символов").oneOf([Yup.ref("user_pass"), null], "Пароли не совпадают"),
        });

        return {
            isOpen,
            services,
            userData,
            schema,
            addUser,
            openModal,
            closeModal,
            getServices,
            openUserDialog
        }
    },
}
</script>
