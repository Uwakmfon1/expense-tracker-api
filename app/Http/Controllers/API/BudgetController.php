<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreBudgetRequest;
use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $budget = Budget::where('user_id', Auth::id())->get();
        try {
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



    public function edit(StoreBudgetRequest $request, $id)
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

}
