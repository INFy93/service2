import { ref, reactive } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";
export default function useUsers() {
    const toast = useToast();

    const users = ref([]);
    const userData = reactive({
        userName: '',
        userLogin: '',
        userEmail: '',
        userPass: '',
        userConfirmPass: '',
        userService: 1,
        userIsAdmin: false
    });
    const currentUser = window.Laravel.user;

    const getUsers = async () => {
        let response = await axios.get("/api/users");
        users.value = response.data.data;
    }

    const blockUser = async (id) => {
        await axios.get("/api/user/block/" + id)
        .then(response => {
            toast.success(response.data)
        })
        .catch(error => {
            toast.error("Сетевая ошибка")
        })
    }

    const createUser = async () => {
        await axios.post("/api/user/add", {
            user: userData
        }).then(response => {
            toast.success("Пользователь успешно добавлен")
        }).catch(error => {
            toast.error("Ошибка добавления пользователя, см. консоль")
        })
    }

    return {
       users,
       userData,
       currentUser,
       getUsers,
       createUser,
       blockUser
    };
}
