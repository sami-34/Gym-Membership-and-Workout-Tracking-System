<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TrainerProfile;
use App\Models\MemberWorkout;
use App\Models\MemberDiet;


class TrainerViewController extends Controller
{
    public function index() {
        // Get all trainers with their profiles
        $trainers = User::where('role', 'trainer')->with('trainerProfile')->get();

        // Get the current member's selected trainer relationship (if any)
        $currentTrainer = null;
        if (auth()->check()) {
            $currentTrainerId = auth()->user()->trainer_id;
            if ($currentTrainerId) {
                $currentTrainer = User::with('trainerProfile')->find($currentTrainerId);
            }
        }

        // Pass both to the view
        return view('member.trainers.index', [
            'trainers' => $trainers,
            'current' => $currentTrainer,
        ]);
    }

    public function selectTrainer(Request $r) {
        auth()->user()->update(['trainer_id'=>$r->trainer_id]);
        return back()->with('success','Trainer selected!');
    }
    public function rateTrainer(Request $r) {
        $tp = TrainerProfile::where('user_id', auth()->user()->trainer_id)->first();
        $tp->rating = ($tp->rating + $r->rating)/2;
        $tp->save();
        return back()->with('success','Thank you for rating!');
    }

    public function myPlan()
    {
        $workouts = MemberWorkout::where('user_id', auth()->id())->with('workout')->get();
        $diets    = MemberDiet::where('user_id', auth()->id())->with('dietPlan')->get();

        return view('member.myplan', compact('workouts', 'diets'));
    }
}
