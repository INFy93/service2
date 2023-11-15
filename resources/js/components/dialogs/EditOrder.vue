<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal">
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="min-h-screen px-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                        enter-to="opacity-100" leave="duration-300 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                        <DialogOverlay class="fixed inset-0 bg-gray-900 bg-opacity-50 dark:bg-opacity-80" />
                    </TransitionChild>

                    <span class="inline-block h-screen align-middle" aria-hidden="true">
                        &#8203;
                    </span>

                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <div
                            class="inline-block w-full max-w-screen-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                            <div class="flex items-start justify-between mb-2 border-b rounded-t dark:border-gray-600">
                                <DialogTitle as="h2" class="text-xl font-semibold leading-6 text-gray-900">
                                    Редактировать заказ:
                                    {{ order.client_login }}
                                </DialogTitle>
                                <div class="float-right mb-2 space-x-4">
                                    <div v-if="!order.client_login">
                                        <img src="/storage/img/load_table.svg" style="width: 20%" class="float-right" />
                                    </div>
                                    <button v-else type="button"
                                        class="inline-flex px-4 py-2 text-sm font-medium text-blue-900 bg-blue-300 border border-transparent rounded-md justify-items-end hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                                        @click="print">
                                        Печать
                                    </button>
                                </div>
                                <div id="printMe" v-if="order.client_login" class="hidden">
                                    <print-order :userdata="order" />
                                </div>
                            </div>
                            <Form @submit="editOrder(order.id)" :validation-schema="schema">
                                <div class="grid grid-cols-2">
                                    <div class="mt-6">

                                        <div class="mb-6">
                                            <label for="client_login"
                                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300">Уникальный
                                                код заказа</label>
                                            <Field type="text" v-model="order.code" id="cleint_login" name="code"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Логин или имя клиента" disabled />
                                        </div>
                                        <div class="mb-6">
                                            <label for="client_login"
                                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300">Логин
                                                (или ФИО, если не наш
                                                абон)*</label>
                                            <Field type="text" v-model="order.client_login" id="cleint_login" name="login"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Логин или имя клиента" required />
                                            <ErrorMessage name="login" class="text-sm text-red-500" />
                                        </div>
                                        <div class="mb-6">
                                            <label for="clent_phone"
                                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300">Телефон*</label>
                                            <Field type="tel" v-model="order.client_phone" id="clent_phone" name="phone"
                                                required
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Телефон" />
                                            <ErrorMessage name="phone" class="text-sm text-red-500" />
                                        </div>
                                        <div class="mb-6">
                                            <label for="product"
                                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300">Тип
                                                устройства*</label>
                                            <Field type="text" v-model="order.product" id="product" name="product"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                required placeholder="ПК, нотубук, роутер..." />
                                            <ErrorMessage name="product" class="text-sm text-red-500" />
                                        </div>
                                        <div class="mb-6">
                                            <label for="model"
                                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300">Бренд*</label>
                                            <Field type="text" v-model="order.model" id="model" name="model"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                required placeholder="Asus, Acer, черный/белый/.. сис" />
                                            <ErrorMessage name="model" class="text-sm text-red-500" />
                                        </div>
                                        <div class="mb-6">
                                            <label for="model_full_name"
                                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300">Модель</label>
                                            <Field type="text" v-model="order.model_full_name" id="model_full_name"
                                                name="model_full_name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="B500, RB950Ui..." />
                                        </div>
                                        <div class="mb-6">
                                            <label for="malfunction"
                                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300">Неисправность*</label>
                                            <Field as="textarea" v-model="order.malfunction" id="malfunction" rows="4"
                                                name="malfunction"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Перенастройка ОС и так далее..." />
                                            <ErrorMessage name="malfunction" class="text-sm text-red-500" />
                                        </div>
                                        <div class="mb-6">
                                            <label for="appearance"
                                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300">Внешний
                                                вид</label>
                                            <Field type="text" v-model="order.appearance" id="appearance" name="appearance"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                        </div>
                                        <div class="mb-6">
                                            <label for="product_complection"
                                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300">Комплектация</label>
                                            <Field as="textarea" v-model="order.product_complection
                                                " id="product_complection" rows="4" name="product_complection"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Ноут + зарядка и тд..." />
                                        </div>
                                        <div class="mb-6">
                                            <label for="marks"
                                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300">Заметки</label>
                                            <Field as="textarea" v-model="order.marks" id="marks" rows="4" name="marks"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Какую ОС ставить или комменты о клиенте :)" />
                                        </div>
                                        <div class="mb-6">
                                            <label for="marks"
                                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-300">Выполненные
                                                работы</label>
                                            <Field as="textarea" v-model="order.works" id="works" rows="4" name="works"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Что было сделано" />
                                        </div>


                                    </div>
                                    <div class="mt-6 ml-3">
                                        <span class="text-lg font-semibold leading-6 text-gray-900">История</span>
                                        <div v-if="!story.length">
                                            <img src="/storage/img/load_table.svg" style="width: 15%" />
                                        </div>
                                        <div v-else v-for="(event, i) in story" :key="event.id" class="text-sm">
                                            <div v-if="i == '0'" class="mt-2 mb-2">
                                                <div class="block ml-auto mr-auto">
                                                    <span>
                                                        <strong>Cоздан:</strong>
                                                    </span>
                                                </div>

                                                <span>
                                                    <i>{{ event.users.name }}</i> [
                                                    {{
                                                        correctDate(
                                                            event.created_at
                                                        )
                                                    }}
                                                    ]
                                                </span>
                                                <div class="mt-3"></div>
                                            </div>
                                            <div v-else class="mt-2 mb-2">
                                                <div v-if="event.statuses
                                                            .status_id == 9
                                                        " class="block ml-auto mr-auto">
                                                    <div class="block ml-auto mr-auto">
                                                        <span>
                                                            <strong>
                                                                {{
                                                                    event.statuses
                                                                        .name
                                                                }}</strong>
                                                        </span>
                                                    </div>
                                                    <span>
                                                        <i>{{
                                                            event.users.name
                                                        }}</i>
                                                        [
                                                        {{
                                                            correctDate(
                                                                event.created_at
                                                            )
                                                        }}
                                                        ]
                                                    </span>
                                                    <div class="mt-1 ml-4">
                                                        <div v-for="(
                                                                elem, index
                                                            ) in event.changes
                                                                        .old_data" :key="index">
                                                            <span v-if="elem == null"><strong>[+] {{ slugs[index]
                                                            }}</strong> ->
                                                                {{
                                                                    event.changes
                                                                        .changed_data[
                                                                    index
                                                                    ]
                                                                }}</span>
                                                            <span v-else>
                                                                {{ elem }} ->
                                                                {{
                                                                    event.changes
                                                                        .changed_data[
                                                                        index
                                                                    ]
                                                                }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div v-else class="mt-2 mb-2">
                                                    <div class="block ml-auto mr-auto">
                                                        <span>
                                                            <strong>{{
                                                                event.statuses
                                                                    .name
                                                            }}</strong>
                                                        </span>
                                                    </div>

                                                    <span>
                                                        <i>{{
                                                            event.users.name
                                                        }}</i>
                                                        [
                                                        {{
                                                            correctDate(
                                                                event.created_at
                                                            )
                                                        }}
                                                        ]
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex float-right mt-4 space-x-4">
                                    <button type="button"
                                        class="inline-flex px-4 py-2 text-sm font-semibold text-blue-900 bg-red-300 border border-transparent rounded-md justify-items-end hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                                        @click="closeModal">
                                        Закрыть
                                    </button>
                                    <button type="submit"
                                        class="inline-flex justify-end px-4 py-2 text-sm font-semibold text-blue-900 bg-blue-300 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
                                        Обновить
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
import { computed, ref } from "vue";
import { useForm } from 'vee-validate';
import useDialogs from "../../composables/dialogs/dialogs";
import useSingleOrder from "../../composables/orders/edit_order";
import useHelpers from "../../composables/common/common";
import useSlugs from "../../composables/common/slugs";
import Print from "../../components/print/Print";
import * as Yup from 'yup';
export default {
    setup(props, { emit }) {
        const { isOpen, openModal, closeModal } = useDialogs();
        const { order, story, getSingleOrder, updateOrder } = useSingleOrder();
        const { correctDate } = useHelpers();
        const { slugs } = useSlugs();

        const openEditDialog = (id) => {
            getSingleOrder(id);
            openModal();
        };



        const phoneRegExp = /^(\+7)?[\s\-]?\(?[489][0-9]{2}?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/
        const schema = Yup.object({
            login: Yup.string().required("Необходимо ввести логин"),
            phone: Yup.string()
                .matches(phoneRegExp, 'Неверный формат номера. Номер должен быть без пробелов и с ПЛЮСОМ перед 7: +79780000000')
                .required("Необходимо ввести телефон"),
            product: Yup.string().required("Необходимо ввести тип устройства"),
            model: Yup.string().required("Необходимо ввести модель"),
            malfunction: Yup.string().required("Необходимо ввести неисправность"),
        });

        const editOrder = async (id, schema) => {
            await updateOrder(id, schema);
            closeModal();
            emit("update-event");
        };



        return {
            isOpen,
            order,
            story,
            slugs,
            schema,
            openModal,
            closeModal,
            getSingleOrder,
            openEditDialog,
            editOrder,
            correctDate,
        };
    },
    methods: {
        print() {
            // Pass the element id here
            this.$htmlToPaper("printMe");
        },
    },
};
</script>
