<template>
    <div>
        <table style="width: 100%" border="0">
            <tbody>
                <tr style="height: 64px">
                    <td style="width: 350px; height: 64px">
                        <p>
                            <span style="font-size: 9pt"><strong>Сервисный Центр "ООО ЦРИТ
                                    "ГИГАБАЙТ"</strong></span><br /><span style="font-size: 9pt">
                                <strong>Адрес:</strong> г. Бахчисарай, ул.
                                Фрунзе 26-Б</span><br /><span style="font-size: 9pt">
                                <strong>Тел.:</strong> 5-22-99, 5-22-55,
                                +7(978)048-48-68, +7(978)048-48-78</span><br /><span style="font-size: 9pt">
                                <strong>Режим работы:</strong> без перерыва и
                                выходных с 9 до 18 часов
                            </span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p style="text-align: center" class="mt-2">
            <span style="text-decoration: underline; font-size: 9pt">Квитанция <strong>№ {{ userdata.services.service_code
            }}-{{ leadingZeros(userdata.id) }}</strong> от
                <em>{{ dateFormat(userdata.created_at) }}</em></span>
        </p>
        <table style="width: 100%" border="0" class="mt-2">
            <tbody>
                <tr style="height: 86.3125px">
                    <td style="width: 50%; height: 86.3125px">
                        <p>
                            <span style="font-size: 9pt"><strong>Клиент:</strong>
                                {{ userdata.client_login }},
                                {{ nicePhone(userdata.client_phone) }}</span><br /><span
                                style="font-size: 9pt"><strong>Устройство:</strong>
                                {{ userdata.product }} {{ userdata.model }} {{ userdata.model_full_name }}</span><br /><span
                                style="font-size: 9pt"><strong>Комплектация:</strong>
                                {{ userdata.product_complection }}</span><br /><span style="font-size: 9pt"><strong>Внешний
                                    вид:</strong>
                                {{ userdata.appearance }}</span><br /><span
                                style="font-size: 9pt"><strong>Неисправность:</strong>
                                {{ userdata.malfunction }}</span>
                        </p>
                    </td>
                    <td style="height: 86.3125px" valign="top">
                        <p>
                            <span style="font-size: 9pt"><strong>Заметки приемщика:</strong></span><br /><span
                                style="font-size: 9pt">{{ userdata.marks }}</span>
                        </p>
                        <p v-if="userdata.code">
                            <span style="font-size: 9pt"><strong>Проверить статус заказа:</strong></span><br /><span
                                style="font-size: 9pt">https://service.crimeastar.net/client</span>
                            <br>
                            <span style="font-size: 9pt"><strong>Код заказа:</strong> {{ userdata.code }}</span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p><span style="font-size: 9pt"> </span></p>
        <p style="text-align: justify" class="mt-2">
            <span style="font-size: 9pt"><strong>ПРАВИЛА ПРИЕМА ТЕХНИКИ В РЕМОНТ</strong></span>
        </p>
        <p style="text-align: justify">
            <span style="font-size: 9pt"><span style="font-size: 9pt">1. Стоимость всех услуг уточняйте заранее во избежание
                    конфликтных ситуаций. На некоторые виды услуг точная
                    стоимость определяется в процессе выполнения работы, в таких
                    случаях обговаривается приблизительная стоимость. Точная
                    стоимость может быть озвучена после проведения
                    диагностики.</span><br /><span style="font-size: 9pt">
                    2. Документом, подтверждающим получение Исполнителем
                    оборудования на ответственное хранение от Владельца,
                    является талон (квитанция) о приеме техники, в котором
                    указывается модель принятого оборудования, его серийный
                    номер, комплектация, фамилия Владельца и его контактная
                    информация.</span><br /><span style="font-size: 9pt">3.
                    <strong>ОБОРУДОВАНИЕ, С СОГЛАСИЯ ЗАКАЗЧИКА, ПРИНЯТО БЕЗ
                        РАЗБОРКИ И ПРОВЕРКИ НЕИСПРАВНОСТЕЙ, БЕЗ ПРОВЕРКИ
                        ВНУТРЕННИХ ПОВРЕЖДЕНИЙ. ЗАКАЗЧИК СОГЛАСЕН, ЧТО ВСЕ
                        НЕИСПРАВНОСТИ И ВНУТРЕННИЕ ПОВРЕЖДЕНИЯ, КОТОРЫЕ МОГУТ
                        БЫТЬ ОБНАРУЖЕНЫ В ОБОРУДОВАНИИ ПРИ ЕГО ТЕХНИЧЕСКОМ
                        ОБСЛУЖИВАНИИ, ВОЗНИКЛИ ДО ПРИЕМА ОБОРУДОВАНИЯ ПО ЭТОМУ
                        ТАЛОНУ (КВИТАНЦИИ).</strong></span><br /><span style="font-size: 9pt">4. Оборудование принимается в
                    сервис в чистом виде. Перед
                    проведением диагностики (в случае необходимости) сервис
                    производит чистку самостоятельно, без предупреждения
                    клиента.</span><br /><span style="font-size: 9pt">
                    5. Неисправности, выявленные в процессе диагностики, и не
                    заявленные Заказчиком, будут устраняться только при
                    оформлении нового запроса на ремонт, после оплаты уже
                    проведенных работ.</span><br /><span style="font-size: 9pt">6. Гарантия распространяется ТОЛЬКО на
                    выполненные работы и
                    замененные запчасти. Гарантия не распространяется на
                    аппараты, которые подверглись воздействию жидкости или
                    механическому воздействию (удар, падение), а также в случае
                    неквалифицированного ремонта или вмешательства сторонними
                    ремонтными организациями. За любые изменения
                    работоспособности данного оборудования в процессе ремонта и
                    диагностики ООО "Центр развития информационных технологий
                    "ГИГАБАЙТ" ответственности не несет.</span><br /><span style="font-size: 9pt">7. Принятое оборудование
                    возвращается только по
                    предъявленному оригиналу талона (квитанции), в комплектации,
                    указанной в талоне (квитанции). В случае утери Талона
                    (квитанции) оборудование возвращается Владельцу только по
                    заявлению и при предъявлении документа, удостоверяющего
                    личность Заказчика, и документов, подтверждающих право
                    владения оборудованием (устройством, техникой).</span><br /><span style="font-size: 9pt">8.
                    <strong>МАСТЕРСКАЯ НЕ НЕСЁТ ОТВЕТСТВЕННОСТИ ЗА ВОЗМОЖНУЮ ПОТЕРЮ
                        ДАННЫХ, НАСТРОЕК, ПО, ИНФОРМАЦИИ И Т.П., ХРАНИМЫХ ВО
                        ВНУТРЕННЕЙ ПАМЯТИ, НА СЪЁМНЫХ НОСИТЕЛЯХ, В ХОДЕ РЕМОНТА
                        ИЛИ ДИАГНОСТИКИ ОБОРУДОВАНИЯ,
                    </strong></span><strong>
                    А ТАКЖЕ ЗА ОСТАВЛЕННЫЕ В ОБОРУДОВАНИИ USB НАКОПИТЕЛИ,
                    АДАПТЕРЫ И Т.П.</strong></span><br /><span style="font-size: 9pt">9. Клиент не возражает на внесение
                изменений в визуальное
                оформление рабочего стола устройства, а также, добавления на
                рабочий стол ссылок на страницу оператора «Гигабайт» в
                социальных сетях (ВКонтакте, Одноклассники, Фейсбук,
                Инстаграмм). По желанию клиента, все внесенные изменения могут
                быть удалены.<br /><span style="font-size: 9pt">10. Срок выполнения ремонта (выполнения ремонтных работ по
                    устранению недостатка) составляет от 1 до 15 рабочих дней
                    при условии наличия необходимых запасных частей (з/ч) на
                    складе. В случае заказа з/ч, срок ремонта может быть
                    увеличен на срок от 15 до 45 рабочих дней.</span><br /><span style="font-size: 9pt">
                    11. Сервисный Центр ООО "Центр развития информационных
                    технологий "ГИГАБАЙТ" принимает на ответственное хранение
                    оборудование от Владельца по Талону (квитанции) на весь срок
                    выполнения работ. Бесплатный срок хранения готового
                    оборудования – 15 дней со дня уведомления Заказчика. По
                    истечении данного срока стоимость хранения оборудования
                    составит 30 рублей в сутки. В случае неявки Владельца за
                    оборудованием в течение 100 дней с момента письменного
                    оповещения Заказчика, оборудование будет реализовано в счет
                    причитающихся Сервисному Центру платежей (согласно главе 4
                    Правил бытового обслуживания населения в Российской
                    Федерации.), либо в случае его неработоспособности или
                    непригодности для ремонта – утилизировано.</span><br /><span style="font-size: 9pt">
                    12. Мастерская оставляет за собой право в одностороннем
                    порядке отказать в ремонте оборудования без объяснения
                    причины принятого решения.</span><br /><span style="font-size: 9pt">
                    13.
                    <strong>КЛИЕНТ ПРИНИМАЕТ НА СЕБЯ ВЕСЬ РИСК, СВЯЗАННЫЙ С
                        ПРОЯВЛЕНИЕМ В ПРОЦЕССЕ РЕМОНТА НЕИСПРАВНОСТЕЙ, НЕ
                        УКАЗАННЫХ В КВИТАНЦИИ.</strong></span></span>
        </p>
        <p style="text-align: justify"><span style="font-size: 9pt"> </span></p>
        <table style="width: 100%" border="0">
            <tbody>
                <tr>
                    <td style="width: 50%" colspan="2" valign="top">
                        <p style="text-align: right">
                            <span style="font-size: 9pt">С условиями ремонта ознакомлен и согласен
                                _____________________ {{ userdata.client_login }}</span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p style="text-align: center">
            <br /><span style="font-size: 9pt">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                - - - - -</span>
        </p>
        <p style="text-align: center"><span style="font-size: 9pt"> </span></p>
        <p style="text-align: center" class="mt-4">
            <span style="text-decoration: underline; font-size: 9pt">Квитанция <strong>№ {{ userdata.services.service_code
            }}-{{ leadingZeros(userdata.id) }}</strong> от
                <em>{{ dateFormat(userdata.created_at) }}</em></span>
        </p>
        <table style="width: 100%" border="0" class="mt-2">
            <tbody>
                <tr>
                    <td style="width: 50%">
                        <p>
                            <span style="font-size: 9pt"><strong>Клиент:</strong> {{ userdata.client_login }},
                                {{ nicePhone(userdata.client_phone) }}</span><br /><span
                                style="font-size: 9pt"><strong>Устройство:</strong>
                                {{ userdata.product }} {{ userdata.model }} {{ userdata.model_full_name }}</span><br /><span
                                style="font-size: 9pt"><strong>Комплектация:</strong>
                                {{ userdata.product_complection }}</span><br /><span style="font-size: 9pt"><strong>Внешний
                                    вид:</strong>
                                {{ userdata.appearance }}</span><br /><span
                                style="font-size: 9pt"><strong>Неисправность:</strong>
                                {{ userdata.malfunction }}</span>
                        </p>
                    </td>
                    <td valign="top">
                        <p>
                            <span style="font-size: 9pt"><strong>Заметки приемщика:</strong></span><br /><span
                                style="font-size: 9pt">{{ userdata.marks }}</span><br />
                        </p>
                        <p style="text-align: right">
                            <span style="font-size: 9pt">С условиями ремонта ознакомлен и согласен
                                _____________________ {{ userdata.client_login }}</span>
                        </p>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import _ from "lodash";
import { computed } from 'vue';
import moment from "moment";
moment.locale("ru");
export default {

    props: {
        userdata: Object,
    },
    created() {
    },
    methods: {
        dateFormat: function (value) {
            if (value) {
                return moment(String(value))
                    .format("LL", { trim: false, useGrouping: false })
                    .replace(/,/g, "");
            }
        },
        leadingZeros(number) {
            return number.toString().padStart(5, '0')
        },
        nicePhone(phone) {
            let lenPhone = phone.length;
            let tt = phone.split('');
            if (lenPhone === 12) {
                tt.splice(2, "", " (");
                tt.splice(6, "", ") ");
                tt.splice(10, "", "-");
                tt.splice(13, "", "-");
            } else if (lenPhone === 13) {
                tt.splice(3, "", " (");
                tt.splice(7, "", ") ");
                tt.splice(11, "", "-");
                tt.splice(14, "", "-");
            }
            return tt.join('');
        }
    },
};
</script>
