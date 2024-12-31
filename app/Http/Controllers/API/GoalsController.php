<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Services\API\GoalService;
use App\Http\Requests\API\StoreGoalRequest;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalsController extends Controller
{
    public GoalService $goalService;
    public function __construct(GoalService $goalService)
    {
     $this->goalService = $goalService;
    }
    public function index()
    {
        return Goal::get();
    }

    public function store(StoreGoalRequest $request)
    {
        return $this->goalService->createGoal($request);
    }

    public function update($id)
    {
        return $this->goalService->updateGoal($id);
    }

    public function delete($id)
    {
        return $this->goalService->deleteGoal($id);
    }
}
