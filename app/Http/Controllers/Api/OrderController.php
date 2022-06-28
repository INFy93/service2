<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrders()
    {
        $orders = Order::with(['services', 'users', 'statuses'])
        ->orderBy('id', 'desc')
        ->paginate(30);

        return OrdersResource::collection($orders);
    }
}
