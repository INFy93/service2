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

    const storePaginationSettings = async() => {
        await axios.post("/api/settings/store/pagination", {
            enabled: settings.value.pagination.enabled,
            per_page: settings.value.pagination.per_page
        }).then(response => {
            console.log(response.data)
        })
    }

    return {
        settings,
        pagination_variants,
        getSettings,
        storePaginationSettings
    }

}
