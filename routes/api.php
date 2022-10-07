<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Get Method
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryListPage']);

// Create With Post Method
Route::post('category/create',[RouteController::class,'categoryList']);

// Delete With Post Method
Route::post('category/delete',[RouteController::class,'categoryDelete']);

// Delete With Get Method
Route::get('category/deleteWithGet/{id}',[RouteController::class,'categoryDeleteWithGet']);

// Details With Get Method
Route::get('category/detailWithGet/{id}',[RouteController::class,'categoryDetailWithGet']);

// Details With Post Method
Route::post('category/detailWithPost',[RouteController::class,'categoryDetailWithPost']);

// Create With Post Method
Route::post('category/update',[RouteController::class,'categoryUpdate']);
