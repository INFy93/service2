<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth']], function () {

    Route::get('/orders', [OrderController::class, 'getOrders']);
    Route::post('/change_status', [OrderController::class, 'changeStatus']);
    Route::get('/search_client', [OrderController::class, 'searchLogin']);

});
