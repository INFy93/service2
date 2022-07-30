import { ref } from "vue";
import axios from "axios";

export default function useClient() {
    const orderInfo = ref({});
    const code = ref("");
    const noOrder = ref(false);

    const getInfoByCode = async () => {
        orderInfo.value = [];
        noOrder.value = false;
        let response = await axios.get("api/code?client_code=" + code.value);
        orderInfo.value = response.data;
        if (!Object.keys(orderInfo.value).length)
        {
            noOrder.value = true
        }
    }

    return {
        orderInfo,
        code,
        noOrder,
        getInfoByCode,
    }
}
