<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Goal;

class GoalController extends Controller
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

    // The showAll method checks for all the goals.
    public function showAll()
    {
        $goals = Goal::all();

        return response()->json($goals);
    }

    // The showOne method checks for a single goal.
    public function showOne($id)
    {
        
        return response()->json(Goal::findOrFail($id));;
    }

    // The create method creates a new goal.
    public function create(Request $request)
    { 
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'start'=> 'required',
            'finish'=> 'required',
        ]);

        $generateRandomString = Str::random(60); 

        $token = hash('sha256', $generateRandomString);

        $goal = new Goal();
        
        $goal->user_id = Auth::user()->id;
        $goal->title = $request->input('title');
        $goal->description = $request->input('description');
        $goal->start = $request->input('start');
        $goal->finish = $request->input('finish');

        $goal->save();

        $res['status'] = True;
        $res['data'] = "$goal->title Created Successfully";
        $res['goal'] = $goal;
        return response()->json($res, 201);

    }

    // The update method checks if an goal exists and allows the resource to be updated.
    public function update($id, Request $request)
    {
        $goal = Goal::findOrFail($id);

        $goal->title = $request->input('title');
        $goal->description = $request->input('description');
        $goal->completed = $request->input('completed');
        $goal->start = $request->input('start');
        $goal->finish = $request->input('finish');

        $goal->save();

        $res['status'] = True;
        $res['data'] = "$goal->title Updated Successfully!";
        $res['goal'] = $goal;
        return response()->json($res, 200);
    }

    // The delete method checks if an goal resource exists and deletes it.
    public function destroy($id, Request $request)
    {

        Goal::findOrFail($id)->delete();

        return response('Deleted Successfully', 200);

    }
}
