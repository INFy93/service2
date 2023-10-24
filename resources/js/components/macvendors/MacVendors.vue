<template>
    <div class="flex flex-row">
        <input name="mac" type="text" placeholder="Ввести MAC" @keyup.enter="getMacVendor"  v-model="mac_raw"  class="w-60 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        <span :class=" is_error ? 'text-red-500' : 'text-grey-800'" class="font-bold text-lg flex justify-center items-center px-2"> {{mac}}</span>
    </div>
    <div class="text-base p-4 mb-4 mt-4 w-100 mr-5 text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
        <span class="font-bold"> Как пользоваться? </span>
    <span>Ввести в поле выше MAC-адрес и нажать Enter.</span> <br>
     <span class="pt-5">Допустимые форматы ввода: </span>
        <div class="px-3 pb-3">
        00-11-22-33-44-55 <br>
        00:11:22:33:44:55 <br>
        00.11.22.33.44.55<br>
        001122334455 <br>
        0011.2233.4455
        </div>
    В случае обнаружения производителя вы сможете его увидеть. Иначе, если в базе данных MACVENDORS нет такого MAC-адреса или же он введен с ошибками, отобразится сообщение об ошибке.
    </div>

</template>

<script>
import useMacVendors from "../../composables/common/macvendor";
export default {
    setup() {
        const { mac, mac_raw, is_error, getMacVendor } = useMacVendors()

        return {
            mac,
            mac_raw,
            is_error,
            getMacVendor
        }
    }
}
</script>
