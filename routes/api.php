<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BudgetController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\GoalsController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\StartSession;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class, 'login']);
Route::post('get-info',[AuthController::class,'getInfo']);

Route::middleware(['auth:sanctum'])->group(function () {



    Route::post('/category/create',[CategoryController::class,'create']);
    Route::get('/category/show',[CategoryController::class,'getCategories']);
    Route::put('/category/update/{id}',[CategoryController::class,'updateCategory']);
    Route::patch('/category/edit/{id}',[CategoryController::class,'editCategory']);
    Route::post('/category/delete',[CategoryController::class,'delete']);


    Route::get('/budgets',[BudgetController::class,'index']);
    Route::post('budget/create',[BudgetController::class,'create']);
    Route::put('budget/update/{id}',[BudgetController::class,'update']);
    Route::post('budget/delete',[BudgetController::class,'destroy']);


    Route::get('/transactions',[TransactionController::class, 'index']);
    Route::post('/transactions',[TransactionController::class, 'store']);
    Route::put('/transactions/update/{id}',[TransactionController::class, 'update']);
    Route::post('/transactions/delete/{id}',[TransactionController::class, 'destroy']);

    Route::get('goals',[GoalsController::class, 'index']);
    Route::post('goals',[GoalsController::class,'store']);
    Route::put('goals/update/{id}',[GoalsController::class,'update']);
    Route::post('goals/delete/{id}',[GoalsController::class,'delete']);

    Route::post('/getInfo',[AuthController::class,'getInfo']);
    Route::post('/logout',[AuthController::class,'logout']);

});




