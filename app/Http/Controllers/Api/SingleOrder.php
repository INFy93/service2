<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Story;
class SingleOrder extends Controller
{
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

        return response()->json($story);
    }
}
