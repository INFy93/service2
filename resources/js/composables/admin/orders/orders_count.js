import { ref } from "vue";
import axios from "axios";
export default function useOrdersCount() {

    const counts = ref([])

    const getCounts = async () => {
        let response = await axios.get("/api/orders_count");
        counts.value = response.data;
    }

    return {
       counts,
       getCounts,
    };
}
