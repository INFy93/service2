import { computed, reactive, ref } from "vue";

export default function addQuickFillList() {

    const quickFill = {
        devices: [
            "ПК",
            "Ноутбук",
            "Роутер",
            "Приставка"
        ],
        brands_pc: [
            "Черный сис",
            "Белый сис"
        ],
        brands_notebook: [
            "Asus",
            "Acer",
            "Lenovo",
            "HP",
            "Dell",
            "MSI",
            "Samsung",
            "eMachines",
            "Toshiba",
            "Гравитон"
        ],
        brands_routers: [
            "TP-Link",
            "Mikrotik",
            "Mercusys",
            "Xiaomi",
            "Asus",
            "Zyxel",
            "D-Link",
            "Huawei",
            "Tenda"
        ],
        malfunctions: [
            "Перенастройка ОС",
            "Черный экран",
            "Не включается",
            "Не загружается",
            "Настройка"
        ],
        complections_router: [
            "Роутер + БП",
            "Роутер без БП",
            "Роутер новый, в коробке"
        ],
        complections_other: [
            "Ноут + зарядка",
            "Ноут + зарядка + сумка",
            "Ноут без зарядки",
            "Полная",
            "Со шнуром"
        ]
    }

    return {
        quickFill
    }

}
