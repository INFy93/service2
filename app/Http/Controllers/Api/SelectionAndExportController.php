<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Exports\OrdersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelectionAndExportController extends Controller
{
    public function selectAll()
    {
        $selected_service = request('service', Auth::user()->service_id);
        $filter = $selected_service == 'all' ? '' : $selected_service;

        return Order::
        when($filter, function($query) use ($filter) {
            $query->where('service', $filter);
        })
        ->orderBy('id', 'desc')
        ->pluck('id');
    }

    public function export($orders)
    {
        $ordersArray = explode(',', $orders);

        return (new OrdersExport($ordersArray))->download('orders.xlsx');
    }
}
