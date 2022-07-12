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

    return {
        selectAll,
        selectPage,
        checked,
        iWillHaveOrders
    }
}
