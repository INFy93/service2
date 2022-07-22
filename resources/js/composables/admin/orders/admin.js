import { ref } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";
export default function useAdminStuff() {
    const toast = useToast();


    const switchService = async (order_id, service) => {
        await axios.get("/api/switch_service/" + order_id + "/" + service)
        .then(response => {
            toast.success("Сервис успешно изменен.")
        }).catch(error => {
            toast.error("Ошибка. Смотрим консоль и кидаем мне скрин.")
        })

    }

    return {
       switchService
    };
}
