<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class RefactorController extends Controller
{
    public function fixNumbers()
    {
        $bad_numbers = Order::select( 'id', 'client_phone')->get();

        $correct_numbers = $bad_numbers->map(function ($item, $key) {
            return [
               'id' => $item->id,
               'client_phone' => str_replace(array('(', ')', ' ', '-'), '', $item->client_phone)
            ];
        });

        $arr = $correct_numbers->toArray();

        foreach ($arr as $a)
        {
            Order::where('id', $a['id'])->update(['client_phone' => $a['client_phone']]);
        }


    }
}
