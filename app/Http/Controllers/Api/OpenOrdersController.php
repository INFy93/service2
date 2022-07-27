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
        $selected_service = request('service', Auth::user()->service_id);
        $filter = $selected_service == 'all' ? '' : $selected_service;

        if (Auth::user()->is_admin)
        {
            $open_orders = Order::where([
                ['status', '!=', 6],
                ['status', '!=', 7]
            ])
            ->when($filter, function($query) use ($filter) {
                $query->where('service', $filter);
            })
            ->count();
        } else
        {
            $open_orders = Order::where([
                ['status', '!=', 6],
                ['status', '!=', 7],
                ['service', '=', Auth::user()->service_id]
            ])
            ->when($filter, function($query) use ($filter) {
                $query->where('service', $filter);
            })
            ->count();
        }


        return response()->json($open_orders);
    }
}
