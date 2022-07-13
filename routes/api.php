<?php

use App\Http\Controllers\Api\OpenOrdersController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SelectionAndExportController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SingleOrder;
use App\Models\Order;
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
    Route::post('/add_order', [OrderController::class, 'addOrder']);

    Route::get('/story/{id}', [SingleOrder::class, 'getStory']);
    Route::get('/order/{id}', [SingleOrder::class, 'getSingleOrder']);
    Route::post('/order', [SingleOrder::class, 'updateOrder']);

    Route::get('/services', [ServiceController::class, 'getServices']);

    Route::get('/open_orders', [OpenOrdersController::class, 'getOpenOrders']);

    Route::get('/select_all', [SelectionAndExportController::class, 'selectAll']);

    Route::get('/export/{orders}', [SelectionAndExportController::class, 'export']);

    Route::get('/st', function () {
        Artisan::call('storage:link');

        return Artisan::output();
     });
});
