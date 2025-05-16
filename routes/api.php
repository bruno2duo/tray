<?php

use App\Http\Controllers\AuthController;
use App\Api\SellersApi;
use App\Api\SalesApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::post('/gettoken', [AuthController::class, 'login']);

// SELLERS
Route::post('/sellers', [SellersApi::class, 'postSellers'])->middleware('auth:sanctum');
Route::get('/sellers', [SellersApi::class, 'getSellers'])->middleware('auth:sanctum');
Route::get('/sellers/{id}', [SellersApi::class, 'getSellersById'])->middleware('auth:sanctum');

// SALES
Route::post('/sales', [SalesApi::class, 'postSale'])->middleware('auth:sanctum');
Route::get('/sales', [SalesApi::class, 'getSales'])->middleware('auth:sanctum');
Route::get('/sales/{id}', [SalesApi::class, 'getSalesBySellerId'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
