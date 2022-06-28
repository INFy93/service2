import { ref } from "vue";
import axios from "axios";
export default function useOrders() {
    const orders = ref([]);
    const user = window.Laravel.user;
    const getOrders = async (page) => {
        if (typeof page === "undefined") {
            page = 1;
        }
        let response = await axios.get("/api/orders?page=" + page);
        orders.value = response.data;
        console.log(user.id);
    };

    const newStatus = async (status_id, order_id) => {
        await axios
            .post("/api/change_status", {
                status_id: status_id,
                rem_id: order_id,
                user_id: user.id,
            })
            .then((response) => {
                console.log("ok");
            })
            .catch((response) => {
                console.log(response.status)
            });
    };

    return {
        orders,
        getOrders,
        newStatus
    };
}
