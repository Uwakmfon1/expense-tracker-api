<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\StartSession;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[AuthController::class,'register']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('login',[AuthController::class, 'login']);

    //Category Routes
    Route::post('/category/create',[CategoryController::class,'create']);
    Route::get('/category/show',[CategoryController::class,'getCategories']);
    Route::put('/category/update/{id}',[CategoryController::class,'updateCategory']);
    Route::patch('/category/edit/{id}',[CategoryController::class,'editCategory']);
    Route::post('/category/delete',[CategoryController::class,'delete']);
});



