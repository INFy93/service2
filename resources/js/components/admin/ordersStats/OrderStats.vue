<template>
    <div class="px-2 py-2">
        <div>
            <RadioGroup v-model="selectedService">
                <RadioGroupLabel class="sr-only">Server size</RadioGroupLabel>
                <div class="flex flex-row space-x-2">
                    <RadioGroupOption as="template" value="all" v-slot="{ active, checked }">
                        <div :class="[
                            active = selectedService == 'all'
                                ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-sky-300'
                                : '',
                            checked = selectedService == 'all' ? 'bg-sky-900 bg-opacity-75 text-white ' : 'bg-white ',
                        ]" class="flex px-2 py-2 rounded-lg shadow-md cursor-pointer focus:outline-none">
                            <div class="flex items-center justify-between w-24">
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <RadioGroupLabel as="p" :class="checked ? 'text-white-600' : 'text-gray-900'"
                                            class="font-medium">
                                            Все сервисы
                                        </RadioGroupLabel>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </RadioGroupOption>
                    <RadioGroupOption as="template" v-for="service in services" :key="service.id" :value="service.id"
                        v-slot="{ active, checked }">
                        <div :class="[
                            active
                                ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-sky-300'
                                : '',
                            checked ? 'bg-sky-900 bg-opacity-75 text-white ' : 'bg-white ',
                        ]" class="flex px-2 py-2 rounded-lg shadow-md cursor-pointer focus:outline-none">
                            <div class="flex items-center justify-between w-24">
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <RadioGroupLabel as="p" :class="checked ? 'text-white' : 'text-gray-900'"
                                            class="font-medium">
                                            {{ service.service_name }}
                                        </RadioGroupLabel>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </RadioGroupOption>
                </div>
            </RadioGroup>
        </div>
        <div class="mt-3 border-t border-gray-300">
            <div class="flex flex-wrap">
                <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                    <!--Metric Card-->
                    <div
                        class="p-5 border-b-4 rounded-lg shadow-xl bg-gradient-to-b from-cyan-200 to-cyan-100 border-cyan-600">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="p-5 rounded-full bg-cyan-600"><i class="fa fa-wallet fa-2x fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold text-gray-600 uppercase">Всего заказов</h2>
                                <p v-if="!Object.keys(service_counts).length">
                                    <img src="/storage/img/load_table.svg" style="width: 36px; margin: 0 auto;" />
                                </p>
                                <p class="text-3xl font-bold">{{ service_counts.total }}</p>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                    <!--Metric Card-->
                    <div
                        class="p-5 border-b-4 border-blue-600 rounded-lg shadow-xl bg-gradient-to-b from-blue-200 to-blue-100">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="p-5 bg-blue-600 rounded-full"><i class="fa fa-wallet fa-2x fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold text-gray-600 uppercase">Новые заказы</h2>
                                <p v-if="!Object.keys(service_counts).length">
                                    <img src="/storage/img/load_table.svg" style="width: 36px; margin: 0 auto;" />
                                </p>
                                <p class="text-3xl font-bold">{{ service_counts.new }}</p>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                    <!--Metric Card-->
                    <div
                        class="p-5 border-b-4 border-green-500 rounded-lg shadow-xl bg-gradient-to-b from-green-200 to-blue-100">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="p-5 bg-green-600 rounded-full"><i class="fas fa-users fa-2x fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold text-gray-600 uppercase">В работе</h2>
                                <p v-if="!Object.keys(service_counts).length">
                                    <img src="/storage/img/load_table.svg" style="width: 36px; margin: 0 auto;" />
                                </p>
                                <p class="text-3xl font-bold">{{ service_counts.at_work }}</p>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                    <!--Metric Card-->
                    <div
                        class="p-5 border-b-4 border-yellow-600 rounded-lg shadow-xl bg-gradient-to-b from-yellow-200 to-yellow-100">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="p-5 bg-yellow-600 rounded-full"><i
                                        class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold text-gray-600 uppercase">На согласовании / ждет запчасть</h2>
                                <p v-if="!Object.keys(service_counts).length">
                                    <img src="/storage/img/load_table.svg" style="width: 36px; margin: 0 auto;" />
                                </p>
                                <p class="text-3xl font-bold">{{ service_counts.waiting }}</p>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                    <!--Metric Card-->
                    <div
                        class="p-5 border-b-4 border-gray-600 rounded-lg shadow-xl bg-gradient-to-b from-gray-200 to-gray-100">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="p-5 bg-gray-600 rounded-full"><i class="fas fa-user-plus fa-2x fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold text-gray-600 uppercase">Готов</h2>
                                <p v-if="!Object.keys(service_counts).length">
                                    <img src="/storage/img/load_table.svg" style="width: 36px; margin: 0 auto;" />
                                </p>
                                <p class="text-3xl font-bold">{{ service_counts.ready }}</p>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full p-6 md:w-1/2 xl:w-1/3">
                    <!--Metric Card-->
                    <div
                        class="p-5 border-b-4 border-gray-600 rounded-lg shadow-xl bg-gradient-to-b from-gray-400 to-gray-200">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="p-5 bg-gray-600 rounded-full"><i class="fas fa-user-plus fa-2x fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold text-gray-600 uppercase">Закрыт</h2>
                                <p v-if="!Object.keys(service_counts).length">
                                    <img src="/storage/img/load_table.svg" style="width: 36px; margin: 0 auto;" />
                                </p>
                                <p class="text-3xl font-bold">{{ service_counts.closed }}</p>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
            </div>
        </div>
    </div>
</template>


<script>

import { onMounted, watch } from "vue";
import useOrders from "../../../composables/orders/orders";
import useAnalytics from "../../../composables/admin/ordersStats/orderStats"
export default {
    setup() {

        const { services, selectedService, getServices } = useOrders()
        const { service_counts, getAnalytics } = useAnalytics()

        onMounted(() => {
            getServices();
            getAnalytics('all');
        })

        watch(selectedService, async (selectedService) => {
            await getAnalytics(selectedService)
        });

        return {
            services,
            selectedService,
            service_counts,
            getAnalytics,
            getServices
        }

    },
}
</script>
