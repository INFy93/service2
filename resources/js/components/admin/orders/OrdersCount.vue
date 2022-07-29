<template>
    <div class="flex flex-wrap">
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-blue-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Всего заказов</h2>
                                    <p v-if="!Object.keys(counts).length">
                                        <img
                                        src="/storage/img/load_table.svg"
                                        style="width: 36px; margin: 0 auto;"
                                    />
                                    </p>
                                   <p class="font-bold text-3xl">{{ counts.total }}</p>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-500 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-green-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Открытые заказы</h2>
                                    <p v-if="!Object.keys(counts).length">
                                        <img
                                        src="/storage/img/load_table.svg"
                                        style="width: 36px; margin: 0 auto;"
                                    />
                                    </p>
                                    <p class="font-bold text-3xl">{{ counts.open }}</p>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-cyan-200 to-cyan-100 border-b-4 border-cyan-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-cyan-600"><i class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">В работе</h2>
                                    <p v-if="!Object.keys(counts).length">
                                        <img
                                        src="/storage/img/load_table.svg"
                                        style="width: 36px; margin: 0 auto;"
                                    />
                                    </p>
                                    <p class="font-bold text-3xl">{{ counts.at_work }}</p>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>
              </div>
</template>

<script>
import useOrdersCount from '../../../composables/admin/orders/orders_count';
import { onMounted } from 'vue';
export default {
    setup() {
        const { counts, getCounts } = useOrdersCount();

        onMounted(() => {
            getCounts();
        });

        return {
            counts,
            getCounts
        }
    },
}
</script>
