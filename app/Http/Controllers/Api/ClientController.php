<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getOrderInfoByCode()
    {
        $code = request('client_code');

        $info = Order::with(['services', 'statuses'])
        ->where('code', $code)
        ->get();

        return response()->json($info);
    }
}
