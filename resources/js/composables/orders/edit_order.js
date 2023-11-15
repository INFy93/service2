import { computed, reactive, ref } from "vue";
import { useToast } from "vue-toastification";
import axios from "axios";
export default function useSingleOrder() {
    const user = window.Laravel.user;
    const order = ref([]);
    const story = ref([]);
    const toast = useToast();

    const getSingleOrder = async (id) => {
        order.value = [];
        story.value = [];
        axios
            .all([axios.get("/api/order/" + id), axios.get("/api/story/" + id)])
            .then(
                axios.spread((data1, data2) => {
                    order.value = data1.data;
                    story.value = data2.data.data;
                })
            );
    };

    const updateOrder = async (id) => {
        await axios
            .post("/api/order", {
                ord_id: id,
                user_id: user.id,
                order: order.value,
            })
            .then((response) => {
                if (response.data === 0)
                    return toast.warning("Нет никаких изменений.");
                toast.success("Заказ успешно обновлен!");
            })
            .catch((error) => {
                toast.error("Ошибка. Смотрим консоль и кидаем мне скрин");
            });
    };

    return {
        order,
        story,
        getSingleOrder,
        updateOrder,
    };
}
