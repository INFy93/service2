<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function switchService($order_id, $service_id)
    {
        $order = Order::find($order_id);

        $order->service = $service_id;

        $order->save();

        return response()->noContent();
    }
}
