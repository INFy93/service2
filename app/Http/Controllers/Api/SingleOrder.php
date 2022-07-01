<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Http\Resources\StoriesResource;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Story;
class SingleOrder extends Controller
{
    public function getSingleOrder($id)
    {
        $order = Order::with('services')->find($id);

        return response()->json($order);
    }

    public function getStory($id)
    {
        $story = Story::with(['statuses' => function ($query) {
            $query->select('status_id', 'name');
        },
        'users' => function ($query) {
            $query->select('id', 'name');
        }])
        ->where('order_id', '=', $id)
        ->get();

        return StoriesResource::collection($story);
    }

    public function updateOrder(Request $req)
    {
        $order = Order::find($req->ord_id);

        $order->appearance = $req->order['appearance'];
        $order->client_login = $req->order['client_login'];
        $order->client_phone = $req->order['client_phone'];
        $order->updated_at = date("Y-m-d H:i:s");
        $order->malfunction = $req->order['malfunction'];
        $order->marks = $req->order['marks'];
        $order->works = $req->order['works'];
        $order->model = $req->order['model'];
        $order->model_full_name = $req->order['model_full_name'];
        $order->product = $req->order['product'];
        $order->product_complection = $req->order['product_complection'];

        $order->save();

        return response()->json('Заказ успешно обновлен!');
    }
}
