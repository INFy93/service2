<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  function () {
    if(Auth::check()) {
        return redirect('/orders');
    }
     else {
        return view('auth.login');
    }
})->name('enter');
Route::get('/logout', [LoginController::class, 'logout']);
Route::view('/orders', 'orders')->name('main');
Auth::routes();
