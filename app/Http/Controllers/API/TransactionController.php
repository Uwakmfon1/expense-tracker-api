<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreExpensesRequest;
use App\Http\Requests\API\StoreIncomeRequest;
use App\Http\Services\TransactionService;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public TransactionService $transactionService;
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(Request $request)
    {
        $transaction = DB::table('expenses')
                ->select('expenses.name as expensesName','expenses.amount as expensesAmount', 'expenses.description')
                ->where('user_id',1)
            ->union(DB::table('incomes')
                ->select('incomes.name as incomeName','incomes.amount as incomeAmount','incomes.received_at')
                ->where('user_id',1))
            ->get();

        return response()->json([
           'success'=>true,
           'message'=>$transaction
        ]);

    }

    public function store(Request $request)
    {
        try {
            $type = $request->input('parent_category_id');

            if($type == 1){
                return $this->transactionService->storeExpenses($request);
            }elseif($type == 2){
                return $this->transactionService->storeIncome($request);
            }
        }catch(\Exception $e){
                return response()->json([
                    'success' => false,
                    'message' =>$e->getMessage()
                ]);
            }
    }

    public function edit()
    {

    }

    public function destroy()
    {

    }


}
