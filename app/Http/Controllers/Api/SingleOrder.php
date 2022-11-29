<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Http\Resources\StoriesResource;
use App\Models\Alias;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Change;

class SingleOrder extends Controller
{
    public function getSingleOrder($id)
    {
        $order = Order::with('services')->find($id);

        return response()->json($order);
    }

    public function getStory($id)
    {
        $story = Story::with([
            'statuses' => function ($query) {
                $query->select('status_id', 'name');
            },
            'users' => function ($query) {
                $query->select('id', 'name');
            },
            'changes'
        ])
            ->where('order_id', '=', $id)
            ->get();

        return StoriesResource::collection($story);
    }

    public function updateOrder(Request $req)
    {
        $order = Order::find($req->ord_id);

        $old_data = collect($order);

        $order->appearance = $req->order['appearance'];
        $order->client_login = $req->order['client_login'];
        $order->client_phone = $req->order['client_phone'];
        $order->malfunction = $req->order['malfunction'];
        $order->marks = $req->order['marks'];
        $order->works = $req->order['works'];
        $order->model = $req->order['model'];
        $order->model_full_name = $req->order['model_full_name'];
        $order->product = $req->order['product'];
        $order->product_complection = $req->order['product_complection'];

        if ($order->isDirty()) {
            $changes = $order->getDirty();
            $unique_id = time();
            $c_changes = collect($changes);
            $diff = $old_data->intersectByKeys($c_changes);

            $changes_table = new Change();
            $changes_table->order_id = $req->ord_id;
            $changes_table->old_data = $diff;
            $changes_table->changed_data = $changes;
            $changes_table->edit_id = $unique_id;

            $story = new Story();
            $story->event = 9;
            $story->user_id = $req->user_id;
            $story->order_id = $req->ord_id;
            $story->edit_id = $unique_id;

            $order->save($changes);
            $story->save();
            $changes_table->save();


            return response()->noContent();
        } else
        {
            return 0;
        }
    }
}
