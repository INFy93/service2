import { ref } from "vue";
import axios from "axios";
export default function useOrders () {

    const orders = ref([]);
    const userService = window.Laravel.user.service_id
    const getOrders = async () => {
        let response = await axios.get("/api/orders");
        orders.value = response.data.data;
    }

    return {
        orders,
        userService,
        getOrders
    }
}
