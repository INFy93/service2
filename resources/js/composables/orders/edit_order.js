import { computed, reactive, ref } from "vue";
import { useToast } from "vue-toastification";
import axios from "axios";
export default function useSingleOrder() {
    const order = ref([]);
    const story = ref([]);

    const getSingleOrder = async(id) => {
        order.value = [];
        story.value = [];
        axios.all([
            axios.get("/api/order/" + id),
            axios.get("/api/story/" + id)
       ]).then(axios.spread((data1, data2) => {
            order.value = data1.data;
            story.value = data2.data.data;
       }));
    }

    return {
        order,
        story,
        getSingleOrder
    };
}
