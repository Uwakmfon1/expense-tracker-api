<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\EditCategoryRequest;
use App\Http\Requests\API\StoreCategoryRequest;
use App\Http\Requests\API\UpdateCategoryRequest;
use App\Models\Categories;
use App\Models\Category;
use App\Models\ParentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use function Pest\Laravel\get;

class CategoryController extends Controller
{
    public function create(StoreCategoryRequest $request)
    {
        $request['type']= ParentCategory::where('id',$request['parent_category_id'])->first()->name;
        $validated = $request->validated();


        try {
            Category::create($validated);
            return response()->json([
                'message'=>'Category saved Successfully',
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

    public function getCategories()
    {
        $query = Category::where('user_id', Auth::id())->get();
        return response()->json([
           'message'=>'Success!',
           'data'=>$query
        ]);
    }

    public function updateCategory(UpdateCategoryRequest $request, $id)
    {
        $validated = $request->validated();

        try{
            Category::where('id',$id)->update($validated);
            return response()->json(['message'=>'Successfully Updated Category'],200);
        }catch (\Exception $e){
            return response()->json([
                'message'=>'Error Found! Could not update.',
                'error'=>$e->getMessage()
            ],400);
        }
    }

    public function editCategory(EditCategoryRequest $request, $id)
    {
        $validated = $request->validated();

        try {
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

}
