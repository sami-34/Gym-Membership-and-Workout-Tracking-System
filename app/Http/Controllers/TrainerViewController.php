<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TrainerProfile;
use App\Models\MemberWorkout;
use App\Models\MemberDiet;


class TrainerViewController extends Controller
{
    public function index(Request $request) 
    {
        $trainers = User::where('role', 'trainer')
        ->whereHas('trainerProfile', function ($q) use ($request) {
            if ($request->filled('rating')) {
                $q->where('rating', '>=', $request->rating);
            }
            if ($request->filled('price')) {
                $q->where('price_per_month', '<=', $request->price);
            }
        })
        ->with('trainerProfile')
        ->get();

        // Get current selected trainer (for rating UI)
        $currentTrainer = null;
        if (auth()->check() && auth()->user()->trainer_id) {
            $currentTrainer = User::with('trainerProfile')->find(auth()->user()->trainer_id);
        }

        return view('member.trainers.index', [
            'trainers' => $trainers,
            'current' => $currentTrainer,
            'filters' => $request->only(['rating', 'price']),
        ]);
    }


    public function selectTrainer(Request $r) 
    {
        auth()->user()->update(['trainer_id'=>$r->trainer_id]);
        return back()->with('success','Trainer selected!');
    }


    public function rateTrainer(Request $r) 
    {
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
