import { reactive, ref } from "vue";
import axios from "axios";
export default function useOrders() {
    const orders = ref([]);
    const user = window.Laravel.user;
    const search = ref("");

    const services = ref([]);
    const selectedService = ref(user.is_admin == 1 ? 'all' : user.service_id);

    const openOrdersCount = ref('');

    const showOnlyOpen = ref(false);

    const getOpenOrdersCount = async () => {
        let response = await axios.get("/api/open_orders");
        openOrdersCount.value = response.data;
    }

    const getServices = async () => {
        let response = await axios.get("/api/services");
        services.value = response.data.data;
    }

    const getOrders = async (page = 1) => {
        let response = await axios.get("/api/orders?page=" + page + "&search=" + search.value + "&selectedService=" + selectedService.value + "&openOrders=" + showOnlyOpen.value);
        orders.value = response.data;
    };

    const newStatus = async (status_id, order_id) => {
        await axios
            .post("/api/change_status", {
                status_id: status_id,
                rem_id: order_id,
                user_id: user.id,
            })
            .catch((response) => {
                toast.error("Ошибка. Смотрим консоль и кидаем мне скрин")
            });
    };

    const onlyOpen = () => {
        showOnlyOpen.value = !showOnlyOpen.value
    }

    return {
        orders,
        search,
        services,
        selectedService,
        openOrdersCount,
        showOnlyOpen,
        getOrders,
        newStatus,
        getServices,
        getOpenOrdersCount,
        onlyOpen
    };
}
