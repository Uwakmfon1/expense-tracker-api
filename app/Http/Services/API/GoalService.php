<?php

namespace App\Http\Services\API;

use App\Http\Requests\API\StoreGoalRequest;

use App\Http\Requests\API\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Goal;
use App\Models\ParentCategory;
use Illuminate\Support\Facades\Log;

class GoalService
{
    public function createGoal( $request)
    {
        try {
            $validated = $request->validated();
            Goal::create($validated);
            return response()->json([
                'message'=>'Goal saved Successfully',
            ],201);
        } catch (\Exception $e) {
            Log::error('Invalid Credentials Supplied', [
                "message"=>$e->getMessage()
            ]);
            return response()->json([
                'message'=>"Couldn't save to database",
                'errors'=>$e->getMessage(),
            ]);
        }
    }

    public function getGoals()
    {
        $query = Goal::where('user_id', 1)->get();   //Auth::id()
        return response()->json([
            'message'=>'Success!',
            'data'=>$query
        ]);
    }

    public function updateGoal(UpdateCategoryRequest $request, $id)
    {
        try{
            $validated = $request->validated();
            Goal::where('id',$id)->update($validated);
            return response()->json(['message'=>'Successfully Updated Goal'],200);
        }catch (\Exception $e){
            return response()->json([
                'message'=>'Error Found! Could not update.',
                'error'=>$e->getMessage()
            ],400);
        }
    }

    public function editGoal(EditCategoryRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            Category::where('id',$id)->update($validated->only(['name','type','description','image_url']));
            return response()->json([
                'success'=>true,
                'message'=>'successfully updated category'
            ],200);
        }catch (\Exception $e){
            return response()->json([
                'message' =>'Update Failed',
                'error'=>$e->getMessage()
            ],400);
        }
    }

    public function deleteGoal($id)
    {
        try{
            Goal::where('id',$id)->delete();
            return response()->json([
                'message' =>'successfully deleted the Goal'
            ],201);
        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage()
            ],401);
        }
    }
}
