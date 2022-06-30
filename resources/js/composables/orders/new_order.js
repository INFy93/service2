import { computed, reactive, ref } from "vue";

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


    const storeOrder = () => {
        alert('SUCCESS!! :-)\n\n' + JSON.stringify(new_order, null, 4));
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
