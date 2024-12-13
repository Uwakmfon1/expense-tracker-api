<?php

namespace App\Http\Services\API;



use App\Models\Expenses;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

;

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

    public function editExpenses(Request $request, $id)
    {
        $validated = Validator::make($request->all(),[
            'table'=>'required',
            'name'=>'required',
            'amount'=>'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ])->validated();

        Expenses::where('id',$id)->update($request->except(['id','table']));
        return response()->json(['message'=>'successfully edited table'],201);
    }

    public function editIncome(Request $request, $id)
    {
        $validated = Validator::make($request->all(),[
            'table'=>'required',
            'category_id'=>'required',
            'name'=>'required',
            'type'=>'required',
            'amount'=>'required',
            'received_at'=>'required'
        ])->validated();

      Income::where('id',$id)->update($request->except(['id','table']));
      return response()->json(['message'=>'successfully edited table'],201);
    }

    public function destroyExpenses(Request $request,$id)
    {
        try{
            $validated = Validator::make($request->all(),[
                'table'=>'required'
            ])->validated();

            Expenses::where('id',$id)->delete();
            return response()->json(['message'=>'Successfully deleted Expense'],201);
        }catch(\Exception $e)
        {
            return response()->json(['message'=>"Could not delete Expense"]);
        }
    }

    public function destroyIncome(Request $request, $id)
    {
        try{
            $validated = Validator::make($request->all(),[
                'table'=>'required'
            ])->validated();
            Income::where('id',$id)->delete();
            return response()->json(['message'=>'Deleted successfully'],200);
        }catch (\Exception $e){
            return response()->json([
                'message'=>"couldn't successfully destroy this record"
            ]);
        }
    }
}
