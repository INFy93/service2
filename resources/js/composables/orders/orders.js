import { ref } from "vue";
import axios from "axios";
export default function useOrders () {

    const orders = ref([]);
    const userService = window.Laravel.user.service_id
    const getOrders = async (page) => {
        if (typeof page === 'undefined') {
            page = 1;
        }
        let response = await axios.get("/api/orders?page=" + page);
        orders.value = response.data;
        console.log(orders.value)
    }

    return {
        orders,
        getOrders
    }
}
