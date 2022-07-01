import { reactive, ref } from "vue";
import axios from "axios";
export default function useOrders() {
    const orders = ref([]);
    const user = window.Laravel.user;
    const search = ref("");

    const getOrders = async (page = 1) => {
        let response = await axios.get("/api/orders?page=" + page + "&search=" + search.value);
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

    return {
        orders,
        search,
        getOrders,
        newStatus
    };
}
