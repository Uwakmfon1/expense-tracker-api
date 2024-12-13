<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\EditCategoryRequest;
use App\Http\Requests\API\StoreCategoryRequest;
use App\Http\Requests\API\UpdateCategoryRequest;
use App\Http\Services\API\CategoryService;
use App\Models\Categories;
use App\Models\Category;
use App\Models\ParentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\get;

class CategoryController extends Controller
{
    public CategoryService $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create(StoreCategoryRequest $request)
    {
        return $this->categoryService->createCategory($request);
    }


    public function getCategories()
    {
        return $this->categoryService->getCategories();
    }

    public function updateCategory(UpdateCategoryRequest $request, $id)
    {
        return $this->categoryService->updateCategory($request, $id);
    }

    public function editCategory(EditCategoryRequest $request, $id)
    {
        return $this->categoryService->editCategory($request, $id);
    }

}
