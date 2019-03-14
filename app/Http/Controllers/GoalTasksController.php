<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Str;

use App\Task;

class GoalTasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show($goal_id)
    {
        $tasks =  Task::where('goal_id', $goal->id)->get();

        return response()->json(['data' => ['success' => true, 'tasks' => $tasks], 200]);

    }

    public function store(Goal $goal)
    {
        $attributes = request()->validate(['description' => 'required|min:255']);

        $goal->addTask($attributes);

        return response()->json($goal);

    }

    public function update(Task $task)
    {
        $task->update([
            'completed' => request()->has('completed')
        ]);

        return back();
    }
 
}
