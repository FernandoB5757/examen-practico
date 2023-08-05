<?php

namespace App\Http\Services;

use App\Models\Task;

class TaskService
{
    public function createService(array $inputs): Task
    {
        return Task::factory()->create([
            ...$inputs
        ]);
    }
}
