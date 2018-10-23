<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::paginate();
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function store(Request $request)
    {
        $task = Task::create($request->input());

        return $task->fresh();
    }

    public function update(Request $request, Task $task)
    {
        if ($request->input('complete')) {
            $task->completed_at = now();
            $task->save();
        }

        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response(null, 204);
    }
}
