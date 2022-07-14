import { reactive, ref } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";
export default function useProfile() {
    const user = window.Laravel.user;
    const userData = ref([]);

    const password = ref("");

    const toast = useToast();

    const getUserData = async() => {
        let response = await axios.get("/api/user/" + user.id)
        userData.value = response.data;
    }

    const changeUser = async () => {
        await axios.post('/api/user/edit', {
            user_id: user.id,
            user: userData.value,

        }).then(response => {
            toast.success("Информация успешно обновлена")
        }).catch(error => {
            toast.error("Ошибка. Смотрим консоль и кидаем мне скрин")
        })
    }

    const updatePassword = async() => {
        await axios.post("/api/user/new_password", {
            user_id: user.id,
            newPassword: password.value
        }).then(response => {
            toast.success("Пароль успешно изменен")
        }).catch(error => {
            toast.error("Ошибка. Смотрим консоль и кидаем мне скрин")
        })
    }

    return {
        userData,
        password,
        getUserData,
        changeUser,
        updatePassword
    };
}
