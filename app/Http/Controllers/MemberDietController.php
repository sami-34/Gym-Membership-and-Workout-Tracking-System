<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberDiet;
use App\Models\DietPlan;
use App\Models\User;

class MemberDietController extends Controller
{
    public function create()
    {

        // MemberWorkoutController@create
        $members = User::where('role','member')->where('trainer_id',auth()->id())->get();
        $diets= DietPlan::where('trainer_id',auth()->id())->get();
        return view('trainer.assign-diet',compact('members','diets'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'diet_plan_id' => 'required|exists:diet_plans,id',
            'day_of_week' => 'required|integer|between:1,7',
            'notes' => 'nullable|string|max:500'
        ]);

         MemberDiet::updateOrCreate(
            [
                'user_id' => $request->user_id, 
                'day_of_week' => $request->day_of_week
            ],
            [
                'diet_plan_id' => $request->diet_plan_id, 
                'notes' => $request->notes,
                'assigned_by'=> auth()->id()
            ]
        );

        return redirect('/assign-diet')->with('success', 'Diet assigned successfully!');
    }
}
