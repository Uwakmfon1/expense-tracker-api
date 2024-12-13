<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BudgetController;
use App\Http\Controllers\API\CategoryController;
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

//Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/category/create',[CategoryController::class,'create']);
    Route::get('/category/show',[CategoryController::class,'getCategories']);
    Route::put('/category/update/{id}',[CategoryController::class,'updateCategory']);
    Route::patch('/category/edit/{id}',[CategoryController::class,'editCategory']);
    Route::post('/category/delete',[CategoryController::class,'delete']);

    //Set Budgets: Users can set monthly budgets for specific categories and see how much they have spent
    Route::get('/budgets',[BudgetController::class,'index']);
    Route::post('budget/create',[BudgetController::class,'create']);
    Route::put('budget/update/{id}',[BudgetController::class,'update']);
    Route::post('budget/delete',[BudgetController::class,'destroy']);

    
    Route::get('/transactions',[TransactionController::class, 'index']);
    Route::post('/transactions',[TransactionController::class, 'store']);
    Route::put('/transactions/update/{id}',[TransactionController::class, 'update']);
    Route::post('/transactions/delete/{id}',[TransactionController::class, 'destroy']);

    // Savings Goals get/goals


    Route::post('/getInfo',[AuthController::class,'getInfo']);
    Route::post('/logout',[AuthController::class,'logout']);
//});



