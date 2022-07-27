import moment from "moment"
moment.locale("ru")
export default function useHelpers () {

    function correctDate(value)
    {
        if (value) {
            return moment(String(value))
                .format("lll", { trim: false, useGrouping: false })
                .replace(/,/g, "");
        }
    }

    function calcDiff(value)
    {
        return moment(value).fromNow();
    }

    function leadingZeros(value)
    {
        return value.toString().padStart(5, "0");
    }

    function declOfNum(number, titles) {
        let cases = [2, 0, 1, 1, 1, 2];
        return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];
    }

    return {
       correctDate,
       calcDiff,
       leadingZeros,
       declOfNum
    }
}
