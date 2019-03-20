<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use App\Task;
use App\Goal;

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

        $tasks =  Task::where('goal_id', $goal_id)->get();

        return response()->json(['data' => ['success' => true, 'tasks' => $tasks], 200]);

    }

    public function showOne($goal_id, $task_id)
    {
        $user = Auth::user();

        $task =  Task::where('goal_id', $goal_id)->where('id', $task_id)->first();

        return response()->json(['data' => ['success' => true, 'task' => $task], 200]);

    }

    public function store(Request $request, $goal_id)
    {
        
        $user = Auth::user();

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'start'=> 'required',
            'finish'=> 'required',
        ]);

        try {
            
            $goal = Goal::where('id', $goal_id)->where('user_id', Auth::id())->first();

            $task = new Task();
            
            $task->goal_id = $goal->id;
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->completed = $request->input('completed');
            $task->start = $request->input('start');
            $task->finish = $request->input('finish');

            $task->save();

            $res['status'] = True;
            $res['data'] = "$task->title Created Successfully";
            $res['task'] = $task;
            return response()->json($res, 200);

        } catch (\Exception $e) {
            
            return response()->json(['error' => true, 'message' => 'request failed'], 409);
        }

    }

    public function update(Request $request, $task_id)
    {
        
        $user = Auth::user();

        try {
            
            $task = Task::findOrFail($task_id);

            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->completed = $request->input('completed');
            $task->start = $request->input('start');
            $task->finish = $request->input('finish');

            $task->save();

            $res['status'] = True;
            $res['data'] = "$task->title Updated Successfully";
            $res['task'] = $task;
            return response()->json($res, 200);

        } catch (\Exception $e) {
            
            return response()->json(['error' => true, 'message' => 'request failed'], 409);
        }

        
    }

    public function destroy(Request $request, $task_id)
    {
        $user = Auth::user();

        $task = Task::findOrFail($task_id);

        $task->delete();

        return response('Deleted Successfully', 200);

    }
 
}
