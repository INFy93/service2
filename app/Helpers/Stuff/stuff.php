<?php

namespace App\Helpers\Stuff;

use App\Models\Story;
use Illuminate\Support\Facades\Http;
class StuffMethods
{
    public static function generateOrderCode()
    {
        $code_length  = 6;
        $symbols  = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789";

        $symbols_array  = str_split($symbols);
        $symbols_number  = count($symbols_array);

        shuffle($symbols_array);
        $code = array();
        $i = 0;
        while ($i < $code_length) {
            $rand = random_int(0, $symbols_number - 1);
            $code[$i] = $symbols_array[$rand];
            if ($i > 0 and strtolower($code[$i]) == strtolower($code[$i - 1])) continue;
            if ($i > 1 and self::same_ctype($code[$i - 2] . $code[$i - 1] . $code[$i])) continue;
            $i++;
        }
        $final_code = implode($code);
        return $final_code;
    }

    public static function same_ctype($string)
    {
        if (ctype_upper($string) or ctype_lower($string) or ctype_digit($string)) {
            return true;
        } else {
            return false;
        }
    }

    public static function sendSMS($phone, $order_id)
    {
        $secret = env('SECRET');

        $send = Http::asForm()->post(env('SEND_SMS_URL'), [
            'phone' => $phone,
            'message' => 'Заказ '.$order_id.' выполнен! Просим оставить отзыв: crimeastar.net/otziv',
            'key' => $secret
        ]);
        if ($send == 'sent') {
            $story = new Story();

            $story->order_id = $order_id;
            $story->event = 8;
            $story->user_id = 0;
            $story->save();

            return response()->json('Сообщение отправлено!');
        } else
        {
            return false;
        }

    }
}
