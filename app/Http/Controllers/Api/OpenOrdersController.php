<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OpenOrdersController extends Controller
{
    public function getOpenOrders()
    {
        if (Auth::user()->is_admin)
        {
            $open_orders = Order::where([
                ['status', '!=', 6],
                ['status', '!=', 7]
            ])
            ->count();
        } else
        {
            $open_orders = Order::where([
                ['status', '!=', 6],
                ['status', '!=', 7],
                ['service', '=', Auth::user()->service_id]
            ])
            ->count();
        }


        return response()->json($open_orders);
    }
}
