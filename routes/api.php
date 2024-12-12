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
    //Category Routes
    Route::post('/category/create',[CategoryController::class,'create']);
    Route::get('/category/show',[CategoryController::class,'getCategories']);
    Route::put('/category/update/{id}',[CategoryController::class,'updateCategory']);
    Route::patch('/category/edit/{id}',[CategoryController::class,'editCategory']);
    Route::post('/category/delete',[CategoryController::class,'delete']);

    //Set Budgets: Users can set monthly budgets for specific categories,
    // such as groceries or transportation, and monitor how much they have spent versus their allocated budget.
    Route::get('/budgets',[BudgetController::class,'index']);
    Route::post('budget/create',[BudgetController::class,'create']);
    Route::get('budget/edit/{id}',[BudgetController::class,'edit']);
    Route::post('budget/update',[BudgetController::class,'update']);
    Route::post('budget/delete/{id}',[BudgetController::class,'destroy']);



//transactions: get put post delete for Expense and Income Logging
//POST /transactions: Log a new expense or income.
//GET /transactions: Retrieve all transactions for a specific user.
//PUT /transactions/{id}: Update an existing transaction.
//DELETE /transactions/{id}: Delete a transaction.

    Route::get('/transactions',[TransactionController::class, 'index']);
    Route::post('/transactions',[TransactionController::class, 'store']);
    Route::put('/transactions',[TransactionController::class, 'edit']);
    Route::post('/transactions/delete',[TransactionController::class, 'destroy']);

// Savings Goals get'/goals
// put/goals/{id}
// post /goals
// delete/budgets/{id}
//    Route::get



    Route::post('/getInfo',[AuthController::class,'getInfo']);
    Route::post('/logout',[AuthController::class,'logout']);
//});



