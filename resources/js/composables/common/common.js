import moment from "moment"
moment.locale("ru")
export default function useHelpers () {

    function correctTime(value)
    {
        if (value) {
            return moment(String(value))
                .format("lll", { trim: false, useGrouping: false })
                .replace(/,/g, "");
        }
    }

    function leadingZeros(value)
    {
        return value.toString().padStart(5, "0");
    }

    return {
       correctTime,
       leadingZeros
    }
}
