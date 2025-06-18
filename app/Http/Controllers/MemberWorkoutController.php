<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberWorkout;
use App\Models\User;
use App\Models\Workout;

class MemberWorkoutController extends Controller
{
    public function create()
    {
        
        // MemberWorkoutController@create
        $members = User::where('role','member')->where('trainer_id',auth()->id())->get();
        $workouts= Workout::where('trainer_id',auth()->id())->get();
        return view('trainer.assign-workout',compact('members','workouts'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'workout_id' => 'required|exists:workouts,id',
            'progress_notes' => 'nullable|string|max:500'
        ]);

        MemberWorkout::create([
            'user_id' => $request->user_id,
            'workout_id' => $request->workout_id,
            'progress_notes' => $request->progress_notes
        ]);

        return redirect('/assign-workout')->with('success', 'Workout assigned successfully!');
    }
}
