<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;


class WorkoutController extends Controller
{
    public function index() {
        $workouts = Workout::where('trainer_id', auth()->id())->get();
        return view('trainer.workouts.index', compact('workouts'));
    }

    public function create() {
        return view('trainer.workouts.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'reps' => 'required|in:12,10,8',
            'sets' => 'required|in:3,2,1'
        ]);

        Workout::create([
            'trainer_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'difficulty_level' => $request->difficulty_level,
            'reps' => $request->reps,
            'sets' => $request->sets
        ]);

        return redirect('/workouts');
    }

}
