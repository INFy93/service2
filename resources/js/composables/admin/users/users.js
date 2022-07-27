import { ref, reactive } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";
export default function useUsers() {
    const toast = useToast();

    const users = ref([]);
    const singleUser = ref([]);
    const confirmPass = ref("");

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

    const getSingleUser = async (id) => {
        let response = await axios.get("/api/user/info/" + id);
        singleUser.value = response.data;
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

    const updateUser = async () => {
        await axios.post("/api/user/update", {
            user: singleUser.value
        }).then(response => {
            toast.success("Информация обновлена")
        }).catch(error => {
            toast.error("Ошибка обновления пользователя, см. консоль")
        })
    }

    return {
       users,
       userData,
       currentUser,
       singleUser,
       confirmPass,
       getSingleUser,
       getUsers,
       createUser,
       blockUser,
       updateUser
    };
}
