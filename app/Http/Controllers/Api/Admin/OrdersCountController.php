<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrdersCountController extends Controller
{
    public function getCount()
    {
        $orders = Order::select('status')->get();

        $total_count = $orders->count();
        $open_count = $orders->whereNotIn('status', [6, 7])->count();
        $at_work_count = $orders->where('status', 2)->count();

        $counts = [
            'total' => $total_count,
            'open' => $open_count,
            'at_work' => $at_work_count,
        ];

        return response()->json($counts);
    }

    public function getServiceOrdersCount()
    {
        $service_id = request('service', 'all');

        if ($service_id == 'all')
        {
            $orders_count = Order::select('status')->get();
        } else
        {
            $orders_count = Order::where('service', $service_id)
            ->select('status')
            ->get();
        }

        $total_orders_count = $orders_count->count();
        $new_orders_count = $orders_count->where('status', 1)->count();
        $at_work_orders_count = $orders_count->where('status', 2)->count();
        $waiting_orders_count = $orders_count->whereIn('status', [3, 4])->count();
        $ready_orders_count = $orders_count->where('status', 5)->count();
        $closed_orders_count = $orders_count->where('status', 6)->count();

        $service_order_counts = [
            'total' => $total_orders_count,
            'new' => $new_orders_count,
            'at_work' => $at_work_orders_count,
            'waiting' => $waiting_orders_count,
            'ready' => $ready_orders_count,
            'closed' => $closed_orders_count
        ];

        return response()->json($service_order_counts);
    }
}
