<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    public function getOrderInfoByCode()
    {
        $code = request('client_code');

        $info = Order::with(['services', 'statuses'])
        ->where('code', $code)
        ->get();

        return response()->json($info);
    }

    public function getMacVendor($mac) {
        try
        {
            $mac_vendor = Http::get('https://api.macvendors.com/'.$mac);

        }
        catch (ConnectionException $exp)
        {
            return 404;
        }

            return $mac_vendor;
    }
}
