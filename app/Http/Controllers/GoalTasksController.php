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

    public function update(Request $request)
    {
        $task->update([
            'completed' => request()->has('completed')
        ]);

        return back();
    }
 
}
