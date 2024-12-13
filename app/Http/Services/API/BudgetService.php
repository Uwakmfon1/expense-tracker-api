<?php

namespace App\Http\Services\API;

use App\Http\Requests\API\DestroyBudgetRequest;
use App\Http\Requests\API\StoreBudgetRequest;
use App\Http\Requests\API\UpdateBudgetRequest;
use App\Models\Budget;

class BudgetService
{

    public function index()
    {
        try {
            $budget = Budget::where('user_id', Auth::id())->get();
            return response()->json([
                'success'=>true,
                'budget'=>$budget
            ]);
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }

    public function create(StoreBudgetRequest $request)
    {
        try{
            $validated = $request->validated();
            $budget = Budget::create($validated);
            return response()->json([
                'success'=>true,
                'message'=>'successfully saved budget',
                'budget'=>$budget
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'error'=>$e->getMessage()
            ],401);
        }
    }

    public function edit()
    {

    }

    public function update(UpdateBudgetRequest $request)
    {
        try{
            $validated = $request->validated();
            Budget::where('id',$validated['id'])->update($validated);
            return response()->json([
                'success'=>true,
                'message'=>'successfully updated budget'
            ],201);
        }catch(\Exception $e){
            return response()->json([
                'success'=>true,
                'message'=>"Couldn't update the budget"
            ],401);
        }
    }


    public function destroy(DestroyBudgetRequest $request)
    {
        try{
            $validated =$request->validated();
            Budget::where('id',$validated['id'])->delete();
            return response()->json([
                'success'=>true,
                'message'=>'successfully deleted budget'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>"Couldn't delete budget"
            ],401);
        }
    }
}
