<?php

use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\Admin\OrdersCountController;
use App\Http\Controllers\Api\Admin\UsersController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\OpenOrdersController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SelectionAndExportController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SingleOrder;
use App\Models\Order;
use App\Models\User;
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

Route::get('/code', [ClientController::class, 'getOrderInfoByCode']);

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
    Route::delete('/orders/delete/{orders}', [OrderController::class, 'deleteOrders']);

    Route::get('/export/{orders}', [SelectionAndExportController::class, 'export']);

    Route::get('/user/{user}', [ProfileController::class, 'getUser']);
    Route::post('/user/edit', [ProfileController::class, 'storeUser']);
    Route::post('/user/new_password', [ProfileController::class, 'changePassword']);

    Route::get('/st', function () {
        Artisan::call('storage:link');

        return Artisan::output();
     });
});

Route::group(['middleware' => ['auth', 'is_admin']], function () {
    Route::get('/orders_count', [OrdersCountController::class, 'getCount']);
    Route::get('/service_orders_count', [OrdersCountController::class, 'getServiceOrdersCount']);

    Route::get('/month_export', [SelectionAndExportController::class, 'exportMonth']);

    Route::get('/switch_service/{order}/{service}', [AdminController::class, 'switchService']);

    Route::get('/users', [UsersController::class, 'getUsers']);
    Route::get('/user/info/{id}', [UsersController::class, 'getSingleUser']);
    Route::get('/user/block/{id}', [UsersController::class, 'blockUser']);
    Route::post('/user/add', [UsersController::class, 'addUser']);
    Route::post('/user/update', [UsersController::class, 'updateUser']);
});
