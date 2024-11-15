<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group( function() {
    Route::get('index',[AuthController::class, 'index']);
    Route::post('create', [AuthController::class,'create']);
});

//nlknajnag
