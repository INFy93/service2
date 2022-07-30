<template>
    <div class="mt-5 ml-3 w-56">
        <div>
            <Form @submit="checkCode" :validation-schema="schema" novalidate>
                <label
                    for="code"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                    >Код
                </label>
                <Field
                    v-model="code"
                    name="code"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Введите код с квитанции"
                />
                    <ErrorMessage name="code" class="text-sm text-red-500" />
                    <button
                        class="mt-2 w-56 justify-end px-4 py-2 text-sm font-medium text-blue-900 bg-blue-300 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                        >
                        Проверить статус заказа
                </button>
            </Form>
        </div>
         <div v-if="orderInfo.length" class="mt-3 text-base" style="width: 25rem;">
                 <p><strong>Сервис:</strong> {{ orderInfo[0].services.service_name}}</p>
                <p><strong>Номер заказа:</strong> {{ orderInfo[0].services.service_code }}-{{ leadingZeros(orderInfo[0].id) }}</p>
                <p><strong>Время приема:</strong> {{ correctDate(orderInfo[0].created_at) }}</p>
                <p><strong>Изменение статуса:</strong> {{ correctDate(orderInfo[0].updated_at) }}</p>
                <p><strong>Статус:</strong> {{ orderInfo[0].statuses.name }}</p>

        </div>
            <div v-if="noOrder" class="mt-5 text-sm text-red-500">Заказ не найден. Проверьте правильность ввода кода заказа. </div>
        </div>
</template>

<script>
import useClient from "../../composables/orders/client";
import useHelpers from "../../composables/common/common"
import * as Yup from 'yup';
export default {
    setup() {
        const { code, orderInfo, noOrder, getInfoByCode } = useClient()
        const { correctDate, leadingZeros } = useHelpers();

        const schema = Yup.object({
            code: Yup.string().required("Необходимо ввести код.")
            .length(6, "Код состоит из 6 символов"),
        });

        const checkCode = async () => {
            console.log(orderInfo.value)
            await getInfoByCode(schema);
        }
        return {
            code,
            orderInfo,
            noOrder,
            schema,
            checkCode,
            correctDate,
            leadingZeros
        }
    },
}
</script>
