import { computed, reactive, ref } from "vue";
import { useToast } from "vue-toastification";
import axios from "axios";
export default function addNewOrder() {
    const user = window.Laravel.user;
    const new_order = reactive({
            client_login: "",
            client_phone: "",
            product: "",
            model: "",
            model_full_name: "",
            product_complection: "",
            malfunction: "",
            appearance: "Царапины, потертости",
            marks: "",
            manager_id: user.id
        });

    const clientData = ref({});
    const show_client_data = ref(false);
    const toast = useToast();

    const storeOrder = async() => {
        await axios.post("/api/add_order", {
            order: new_order
        }).then(response => {
           new_order.client_login = ""
           new_order.client_phone = ""
           new_order.product = ""
           new_order.model = ""
           new_order.model_full_name = ""
           new_order.product_complection = ""
           new_order.malfunction = ""
           new_order.appearance = "Царапины, потертости"
           new_order.marks = ""
            toast.success("Заказ успешно добавлен!")
        })
        .catch(response => {
            toast.error("Ошибка. Смотрим консоль и кидаем мне скрин")
        })
    }

    const searchLogins = async () => {
        if (new_order.client_login.length >= 3)
        {
            show_client_data.value = true
            let response = await axios.get("/api/search_client?q=" + new_order.client_login);
            clientData.value = response.data;
        } else
        {
            show_client_data.value = false
            clientData.value = {}
        }
    }

    function autoComplete(login, phone)
    {
        new_order.client_login = login
        new_order.client_phone = phone
        show_client_data.value = false
    }

    function addMalfunction(event)
    {
        new_order.malfunction = event.target.innerHTML
    }
    function addComplection(event)
    {
        new_order.product_complection = event.target.innerHTML
    }
    function addModel(event)
    {
        new_order.model = event.target.innerHTML
    }
    function addProduct(event)
    {
        new_order.product = event.target.innerHTML
    }

    return {
       user,
       new_order,
       clientData,
       show_client_data,
       searchLogins,
       autoComplete,
       storeOrder,
       addMalfunction,
       addComplection,
       addModel,
       addProduct
    };
}
