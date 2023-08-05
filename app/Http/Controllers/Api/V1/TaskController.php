<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\TaskResource;
use App\Http\Services\TaskService;
use App\Models\Company;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function create(StoreTaskRequest $request, TaskService $creator)
    {
        $user = User::countTasksNotCompleted()->find($request->user_id);
        $this->authorize('create', [Task::class, $user]);

        $task = $creator->createService($request->all());

        return TaskResource::make($task->load(['company', 'user']));
    }

    /**
     * Return  companies
     */
    public function companies(Request $request)
    {
        $search = $request['search'] ?? null;
        $companies = Company::with(['tasks']);

        if ($search)
            $companies->searchByName($search);

        return CompanyResource::collection($companies->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
