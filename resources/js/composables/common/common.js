import moment from "moment";
import "moment/dist/locale/ru";
moment.locale("ru");
export default function useHelpers() {
    function correctDate(value) {
        if (value) {
            return moment(String(value))
                .format("lll", { trim: false, useGrouping: false })
                .replace(/,/g, "");
        }
    }

    function calcDiff(value) {
        return moment(value).fromNow();
    }

    function leadingZeros(value) {
        return value.toString().padStart(5, "0");
    }

    function declOfNum(number, titles) {
        let cases = [2, 0, 1, 1, 1, 2];
        return titles[
            number % 100 > 4 && number % 100 < 20
                ? 2
                : cases[number % 10 < 5 ? number % 10 : 5]
        ];
    }

    function nicePhone(phone) {
        let lenPhone = phone.length;
        let tt = phone.split("");
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
        return tt.join("");
    }

    return {
        correctDate,
        calcDiff,
        leadingZeros,
        declOfNum,
        nicePhone,
    };
}
