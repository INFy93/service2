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
}
