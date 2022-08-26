import axios from 'axios';
import { ref } from 'vue';

export default function useSettings () {

    const settings = ref([]);
    const pagination_variants = [
        '15',
        '30',
        '45',
        '60'
    ]

    const getSettings = async () => {
        let response = await axios.get("/api/settings");
        settings.value = response.data.data[0].settings;
    }

    return {
        settings,
        pagination_variants,
        getSettings
    }

}
