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
                                        class="text-xl font-semibold leading-6 text-gray-900"
                                    >
                                        Добавить заказ
                                    </DialogTitle>
                                </div>
                                <Form @submit="addOrder" :validation-schema="schema" class="mt-6">
                                    <div class="mb-6">
                                        <label
                                            for="login"
                                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300"
                                            >Логин (или ФИО, если не наш
                                            абон)*</label
                                        >
                                        <Field name="login" type="text" v-model="new_order.client_login" @keyup="searchLogins" placeholder="Логин или имя клиента" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                                        <ErrorMessage name="login" class="text-sm text-red-500" />
                                        <Menu>
                                            <MenuItems :static="show_client_data"
                                                v-if="clientData.length"
                                                class="absolute z-10 w-96 mt-1 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                            >
                                                <div class="px-1 py-1">
                                                    <MenuItem v-for="client in clientData"
                                                    :key="client.id">
                                                        <a
                                                            href="#"
                                                            status_id="1"
                                                            @click.stop.prevent
                                                            @click="
                                                                autoComplete(client.client_login, client.client_phone)
                                                            "
                                                            class="flex flex-row  py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                            >
                                                            <span class="justify-start">{{client.client_login}}</span>
                                                            <span class="ml-auto" >{{client.client_phone}}</span>
                                                        </a>
                                                    </MenuItem>
                                                </div>
                                            </MenuItems>
                                        </Menu>
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            for="phone"
                                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300"
                                            >Телефон*</label
                                        >
                                        <Field name="phone" type="tel" v-model="new_order.client_phone" v-maska="'+7 (###) ###-##-##'" placeholder="+7 (xxx) xxx-xx-xx" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                                        <ErrorMessage name="phone" class="text-sm text-red-500"/>
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            for="product"
                                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300"
                                            >Тип устройства*</label
                                        >
                                        <div class="flex space-x-2">
                                                    <a href="#" @click="addProduct" class="text-sm text-blue-600 hover:underline">ПК</a>
                                                    <a href="#" @click="addProduct" class="text-sm text-blue-600 hover:underline">Ноутбук</a>
                                                    <a href="#" @click="addProduct" class="text-sm text-blue-600 hover:underline">Роутер</a>
                                                    <a href="#" @click="addProduct" class="text-sm text-blue-600 hover:underline">Приставка</a>
                                        </div>
                                        <Field name="product" type="text" v-model="new_order.product" placeholder="ПК, роутер..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                                        <ErrorMessage name="product" class="text-sm text-red-500"/>
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            for="model"
                                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300"
                                            >Бренд*</label
                                        >
                                         <div class="flex space-x-1">
                                            <span class="text-sm font-semibold">ПК:</span>
                                            <div class="flex space-x-2">
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Черный сис</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Белый сис</a>
                                            </div>
                                         </div>
                                        <div class="flex space-x-1">
                                            <span class="text-sm font-semibold">Ноутбуки:</span>
                                            <div class="flex space-x-2">
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Asus</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Acer</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Lenovo</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">HP</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">MSI</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Samsung</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">eMachines</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Гравитон</a>
                                            </div>
                                        </div>
                                        <div class="flex space-x-1">
                                            <span class="text-sm font-semibold">Роутеры:</span>
                                            <div class="flex space-x-2">
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">TP-LINK</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Mikrotik</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Mercusys</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Xiaomi</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Asus</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Zyxel</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">D-Link</a>
                                                        <a href="#" @click="addModel" class="text-sm text-blue-600 hover:underline">Huawei</a>
                                            </div>
                                        </div>
                                        <Field name="model" type="text" v-model="new_order.model" placeholder="Asus, Acer, черный/белый сис..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                                        <ErrorMessage name="model" class="text-sm text-red-500"/>
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            for="model"
                                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300"
                                            >Модель*</label
                                        >
                                        <Field name="model_full" type="text" v-model="new_order.model_full_name" placeholder="B500, RB950Ui..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            for="malfunction"
                                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300"
                                            >Неисправность*</label
                                        >
                                        <div class="flex space-x-2">
                                                    <a href="#" @click="addMalfunction" class="text-sm text-blue-600 hover:underline">Перенастройка ОС</a>
                                                    <a href="#" @click="addMalfunction" class="text-sm text-blue-600 hover:underline">Черный экран</a>
                                                    <a href="#" @click="addMalfunction" class="text-sm text-blue-600 hover:underline">Не включается</a>
                                                    <a href="#" @click="addMalfunction" class="text-sm text-blue-600 hover:underline">Не загружается</a>
                                                    <a href="#" @click="addMalfunction" class="text-sm text-blue-600 hover:underline">Настройка</a>
                                        </div>
                                        <Field
                                            as="textarea"
                                            v-model="new_order.malfunction"
                                            name="malfunction"
                                            rows="4"
                                            class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"

                                            placeholder="Перенастройка ОС и так далее..."
                                        ></Field>
                                        <ErrorMessage name="malfunction" class="text-sm text-red-500"/>
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            for="appearance"
                                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300"
                                            >Внешний вид</label
                                        >
                                        <Field
                                            type="text"
                                            v-model="new_order.appearance"
                                            name="appearance"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        />
                                    </div>
                                     <div class="mb-6">
                                        <label
                                            for="product_complection"
                                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300"
                                            >Комплектация</label
                                        >
                                        <div class="flex space-x-2">
                                                    <a href="#" @click="addComplection" class="text-sm text-blue-600 hover:underline">Роутер + бп</a>
                                                    <a href="#" @click="addComplection" class="text-sm text-blue-600 hover:underline">Роутер без бп</a>
                                                    <a href="#" @click="addComplection" class="text-sm text-blue-600 hover:underline">Роутер новый, в коробке</a>
                                        </div>
                                        <div class="flex space-x-2">
                                                    <a href="#" @click="addComplection" class="text-sm text-blue-600 hover:underline">Ноут + зарядка</a>
                                                    <a href="#" @click="addComplection" class="text-sm text-blue-600 hover:underline">Ноут + зарядка + сумка</a>
                                                    <a href="#" @click="addComplection" class="text-sm text-blue-600 hover:underline">Ноут без зарядки</a>
                                                    <a href="#" @click="addComplection" class="text-sm text-blue-600 hover:underline">Полная</a>
                                                    <a href="#" @click="addComplection" class="text-sm text-blue-600 hover:underline">Со шнуром</a>
                                        </div>
                                        <Field
                                            as="textarea"
                                            v-model="
                                                new_order.product_complection
                                            "
                                            name="product_complection"
                                            rows="4"
                                            class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ноут + зарядка и тд..."
                                        ></Field>
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            for="marks"
                                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300"
                                            >Заметки</label
                                        >
                                        <Field
                                            as="textarea"
                                            v-model="new_order.marks"
                                            name="marks"
                                            rows="4"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Какую ОС ставить или комменты о клиенте :)"
                                        ></Field>
                                    </div>
                                     <div class="mt-4 flex space-x-4 float-right">
                                        <button
                                            type="button"
                                            class="inline-flex justify-items-end px-4 py-2 text-sm font-semibold text-blue-900 bg-red-300 border border-transparent rounded-md hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                                            @click="closeModal"
                                        >
                                            Закрыть
                                        </button>
                                        <button
                                            class="inline-flex justify-end px-4 py-2 text-sm font-semibold text-blue-900 bg-blue-300 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
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
import { onMounted, watch } from "vue";
import useDialogs from "../../composables/dialogs/dialogs"
import addNewOrder from "../../composables/orders/new_order"
import { useToast } from "vue-toastification";
import { useForm, useField } from 'vee-validate';
import * as Yup from 'yup';
export default {
    setup() {
        const { isOpen, openModal, closeModal } = useDialogs();
        const { new_order, clientData, show_client_data, addProduct, addMalfunction, addComplection, addModel, storeOrder, searchLogins, autoComplete } = addNewOrder();

        const toast = useToast();

        const schema = Yup.object({
            login: Yup.string().required("Необходимо ввести логин"),
            phone: Yup.string().required("Необходимо ввести телефон"),
            product: Yup.string().required("Необходимо ввести тип устройства"),
            model: Yup.string().required("Необходимо ввести модель"),
            malfunction: Yup.string().required("Необходимо ввести неисправность"),
        });
        const addOrder = async() => {
            await storeOrder(schema);
        }
        return {
           toast,
           new_order,
           schema,
           clientData,
           isOpen,
           show_client_data,
           closeModal,
           openModal,
           searchLogins,
           autoComplete,
           addMalfunction,
           addComplection,
           addModel,
           addProduct,
           addOrder,
        };
    }
};
</script>

