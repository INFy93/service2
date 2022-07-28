import { reactive, ref } from "vue";
import { useToast } from "vue-toastification";
import axios from "axios";

export default function useSelection() {
    const selectPage = ref(false);
    const selectAll = ref(false);
    const checked = ref([]);

    const toast = useToast();

    const iWillHaveOrders = async (service) => {
        checked.value = [];
        await axios.get('/api/select_all?service=' + service).then(response => {
            checked.value = response.data;
            selectAll.value = true;
        }).catch((response) => {
            toast.error("Ошибка. Смотрим консоль и кидаем мне скрин")
    });
    }

    const removeOrders = async () => {
        axios.delete("/api/orders/delete/" + checked.value).then(response => {
            if (response.status === 204)
            {
                toast.success("Выбранные заказы успешно удалены.");
                checked.value = [];
            } else
            {
                toast.error("Что-то пошло не так. См. консоль...")
            }
        }).catch(error => {
            toast.error("Ошибка. Смотрим консоль и кидаем мне скрин")
        })
    }


    return {
        selectAll,
        selectPage,
        checked,
        iWillHaveOrders,
        removeOrders
    }
}
