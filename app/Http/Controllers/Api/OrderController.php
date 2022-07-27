<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    public function getOrders()
    {
        $search_term = request('search', '');

        $selected_service = request('selectedService', Auth::user()->service_id);
        $filter = $selected_service == 'all' ? '' : $selected_service;

        $filter_by_open_orders =  request('openOrders') == 'false' || request('openOrders') == null ? false : true;

        $orders = Order::with(['services', 'users', 'statuses'])
        ->when($filter, function($query) use ($filter) {
            $query->where('service', $filter);
        })
        ->when($filter_by_open_orders, function($query) {
            $query->where('status', '!=', 6);
        })
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

        if ($req->status_id == '6')
        {
            \Stuff::sendSMS(str_replace(array('(', ')', ' ', '-'), '', $order->client_phone), $req->rem_id);
        }
    }

    public function searchLogin()
    {
    	$key = \Request::get('q');

        $client_data = Order::where('client_login','LIKE',"%{$key}%")
        ->select('id', 'client_login', 'client_phone')
        ->orderBy('id', 'desc')
        ->limit(15)
        ->get();

    	return response()->json($client_data);
    }

    public function addOrder(Request $req)
    {
        $today = date("Y-m-d H:i:s", time()+60*60*24*4);

        //creating array for db insert from request
        $new_order = [
            'code' => \Stuff::generateOrderCode(),
            'client_login' => $req->order['client_login'],
            'appearance' => $req->order['appearance'],
            'client_phone' => $req->order['client_phone'],
            'malfunction' => $req->order['malfunction'],
            'marks' => $req->order['marks'],
            'model' => $req->order['model'],
            'model_full_name' => $req->order['model_full_name'],
            'product' => $req->order['product'],
            'product_complection' => $req->order['product_complection'],
            'status' => 1,
            'manager_id' => $req->order['manager_id'],
            'service' => Auth::user()->service_id,
            'created_at' =>  date("Y-m-d H:i:s"),
            'updated_at' =>  date("Y-m-d H:i:s"),
        ];

        Order::insert($new_order);

        $order = Order::orderBy('id', 'desc')->first();

        $story = [
            'user_id' => $req->order['manager_id'],
            'order_id' => $order->id,
            'event' => 1,
            'created_at' =>  date("Y-m-d H:i:s"),
            'updated_at' =>  date("Y-m-d H:i:s"),
        ];
        Story::insert($story);

        return response()->json("Заказ успешно добавлен");
    }

    public function deleteOrders($orders)
    {
        $orderArray = explode(',', $orders);

        Order::whereKey($orderArray)->delete();

        return response()->noContent();
    }

}
