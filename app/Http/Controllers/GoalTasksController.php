<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        
        $this->middleware('auth');

    }

    public function showAll($goal_id)
    {
        $user = Auth::user();

        $tasks =  Task::where('goal_id', $goal->id)->get();

        return response()->json(['data' => ['success' => true, 'tasks' => $tasks], 200]);

    }

    public function showOne($goal_id)
    {
        $user = Auth::user();
        $task =  Task::where('goal_id', $goal->id)->first();

        return response()->json(['data' => ['success' => true, 'task' => $task], 200]);

    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'start'=> 'required',
            'finish'=> 'required',
        ]);

        $task = new Task();

        $task->description = $request->input('description');
        $task->start = $request->input('start');
        $task->finish = $request->input('finish');

        $task->save();

        $res['status'] = True;
        $res['data'] = "$task->description Created Successfully";
        $res['task'] = $task;
        return response()->json($res, 201);
    }

    public function update(Task $task)
    {
        $task->update([
            'completed' => request()->has('completed')
        ]);

        return back();
    }
 
}
