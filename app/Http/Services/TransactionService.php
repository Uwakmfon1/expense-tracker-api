<?php

namespace App\Http\Services;



use App\Models\Expenses;
use App\Models\Income;
use Illuminate\Support\Facades\Validator;;
use Illuminate\Http\Request;

class TransactionService
{

    public function storeExpenses(Request $request)
    {
     $validated = Validator::make($request->all(),[
         'parent_category_id'=>'required',
         'category_id'=>'required',
         'user_id'=>'required',
         'name'=>'required',
         'amount'=>'required',
         'description'=>'required|string',
         'start_date'=>'required',
         'end_date'=>'required'
     ])->validated();

     return Expenses::create($validated);
    }

    public function storeIncome(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'parent_category_id'=>'required',
            'category_id'=>'required',
            'user_id'=>'required',
            'name'=>'required',
            'type'=>'required|in:one time,daily,weekly,monthly,yearly',
            'amount'=>'required',
            'received_at'=>'required',
            'description'=>'required|string'
        ])->validated();

        return Income::create($validated);
    }


}
