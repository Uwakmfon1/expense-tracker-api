<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreBudgetRequest;
use App\Http\Requests\API\UpdateBudgetRequest;
use App\Http\Services\API\BudgetService;
use App\Models\Budget;
use Illuminate\Http\Request;
use App\Http\Requests\API\DestroyBudgetRequest;
class BudgetController extends Controller
{
    public BudgetService $budgetService;
    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;
    }

    public function index()
    {
        return $this->budgetService->index();
    }

    public function create(StoreBudgetRequest $request)
    {
        return $this->budgetService->create($request);
    }


    public function update(UpdateBudgetRequest $request)
    {
        return $this->budgetService->update($request);
    }

    public function destroy(DestroyBudgetRequest $request)
    {
            return $this->budgetService->destroy($request);

    }

}
