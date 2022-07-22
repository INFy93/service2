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
}
