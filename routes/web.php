<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebApp\ProductController;
use App\Http\Controllers\WebApp\AuthController;
use App\Http\Controllers\WebApp\MainController;


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

Route::group(['middleware' => ['auth']], function() {

    Route::group(['middleware' => 'EnsureUserHasCustomerRole:customer'], function() {
        Route::get('/customer',[MainController::class,'index']);
        Route::get('/customer-order',[MainController::class,'orderList']);
        Route::get('/customer/order/{id}',[MainController::class,'customerOrder']);
        Route::post('/customer/order/{product_id}',[MainController::class,'customerOrderStore']);    
    });

    Route::post('/customer-register',[AuthController::class,'customerRegister']);
    Route::post('/logout',[AuthController::class,'logout']);
  
    Route::get('/business',[ProductController::class,'index']);
    Route::get('/business/create',[ProductController::class,'create']);
    Route::post('/business',[ProductController::class,'store']);
    Route::get('/business/{id}/edit',[ProductController::class,'edit']);
    Route::put('/business/{id}',[ProductController::class,'update']);
    Route::delete('/business/{id}',[ProductController::class,'destroy']);

});

Route::get('/', function () { return view('welcome');})->name('login');
Route::get('/businness-login', function () { return view('business_login');});
Route::get('/customer-login', function () { return view('customer_login');});
Route::get('/customer-register', function () { return view('customer_register');});

Route::post('/business-login',[AuthController::class,'businnessLogin']);
Route::post('/customer-login',[AuthController::class,'customerLogin']);

// Route::resource('/business', ProductController::class);

