import axios from "axios";
import { ref } from "vue";

export default function useMacVendors() {
    const mac = ref('');
    const mac_raw = ref('');
    const is_error = ref(false);

    const getMacVendor = async () => {
        if (mac_raw.value.length >6 ) {
            is_error.value = false
            mac.value = 'Запрос...'
            let response = await axios.get('/api/mac/' + mac_raw.value);
            console.log(response)

            if (!Object.hasOwn(response.data, 'errors')) {
                mac.value = response.data
            } else {
                mac.value = "Ошибка! Неверная запись MAC-адреса или такой MAC-адрес не найден в базе macvendors.com"
                is_error.value = true
            }
        }


    }
    return {
        mac,
        mac_raw,
        is_error,
        getMacVendor
    }
}
