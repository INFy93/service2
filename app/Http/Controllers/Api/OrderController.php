<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Story;
class OrderController extends Controller
{
    public function getOrders()
    {
        $search_term = request('search', '');


        $orders = Order::with(['services', 'users', 'statuses'])
        ->search(trim($search_term))
        ->orderBy('id', 'desc')
        ->paginate(30);

        return OrdersResource::collection($orders);
    }

    public function changeStatus(Request $req)
    {
        $order = Order::find($req->rem_id);
        $story = new Story();

        $order->status = $req->status_id;

        $story->event = $req->status_id;
        $story->user_id = $req->user_id;
        $story->order_id = $req->rem_id;

        $order->save();
        $story->save();
    }
}
