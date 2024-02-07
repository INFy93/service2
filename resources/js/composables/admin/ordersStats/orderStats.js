import { ref } from "vue";
import axios from "axios";

export default function useAnalytics() {

    const service_counts = ref([]);

    const getAnalytics = async (service_id) => {
        service_counts.value = [];
        let response = await axios.get("/api/service_orders_count?service=" + service_id);
        service_counts.value = response.data;
    }

    return {
        service_counts,
        getAnalytics
    }
}
