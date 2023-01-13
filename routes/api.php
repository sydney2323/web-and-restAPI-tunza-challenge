<?php

use Illuminate\Http\Request;
use App\Http\Controllers\RestApi\AuthController;
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
Route::post('/v1/login',[AuthController::class,'login']);
Route::get('/v1/product-list',[AuthController::class,'productList']);

Route::middleware(['auth:api', 'role'])->group(function() {

    Route::middleware(['scope:customer'])->group(function () {
       Route::post('/v1/customer-order',[AuthController::class,'customerOrderStore']);
    });

 });
