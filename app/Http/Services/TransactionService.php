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

    public function editExpenses(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'id'=>'required',
            'table'=>'required',
            'name'=>'required',
            'amount'=>'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ])->validated();

        Expenses::where('id',$validated['id'])->update($request->except(['id','table']));
        return response()->json(['message'=>'successfully edited table'],201);
    }

    public function editIncome(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'id'=>'required',
            'table'=>'required',
            'category_id'=>'required',
            'name'=>'required',
            'type'=>'required',
            'amount'=>'required',
            'received_at'=>'required'
        ])->validated();

      Income::where('id',$validated['id'])->update($request->except(['id','table']));
      return response()->json(['message'=>'successfully edited table'],201);
    }

    public function destroyExpenses(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'id'=>'required',
            'table'=>'required'
        ])->validated();

        Expenses::where('id',$validated['id'])->delete();
        return response()->json(['message'=>'successfully deleted record'],201);
    }

    public function destroyIncome(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'id'=>'required',
            'table'=>'required'
        ])->validated();
        Income::where('id',$validated['id'])->delete();
        return response()->json(['message'=>'deleted successfully'],200);
    }
}
