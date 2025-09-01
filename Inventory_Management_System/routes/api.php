<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Middleware\LogApiResponseSize;




// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', LogApiResponseSize::class])->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products/store', [ProductController::class, 'store']);
    Route::post('/products/update/{id}', [ProductController::class, 'update']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/suppliers', [SupplierController::class, 'index']);    
    Route::post('/suppliers/store', [SupplierController::class, 'store']);
    Route::post('/suppliers/update/{id}', [SupplierController::class, 'update']);
    Route::get('/suppliers/{id}', [SupplierController::class, 'show']);

    Route::delete('/logout', [AuthController::class, 'logout']); 

});

