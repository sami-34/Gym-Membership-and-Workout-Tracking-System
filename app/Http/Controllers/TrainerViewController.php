<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TrainerProfile;
use App\Models\MemberWorkout;
use App\Models\MemberDiet;


class TrainerViewController extends Controller
{
    public function index(Request $request) {
        // $query = User::where('role', 'trainer')->with('trainerProfile');

        // // Filter by rating (if provided)
        // if ($request->filled('rating')) {
        //     $query->whereHas('trainerProfile', function ($q) use ($request) {
        //         $q->where('rating', '>=', $request->rating);
        //     });
        // }

        // // Filter by price (if provided)
        // if ($request->filled('price')) {
        //     $query->whereHas('trainerProfile', function ($q) use ($request) {
        //         $q->where('price_per_month', '<=', $request->price);
        //     });
        // }

        // $trainers = $query->get();
         // 🔎 Custom linear search to filter trainers
        $trainers = $this->linearSearchTrainers($request);

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

    /*
        *ALGORITHM USED: Linear Search to filter trainers by rating and/or price.  
    */
    private function linearSearchTrainers(Request $request)
    {
        $all = User::where('role', 'trainer')->with('trainerProfile')->get();

        $filtered = [];

        foreach ($all as $trainer) {
            $profile = $trainer->trainerProfile;

            if (!$profile) continue;

            // Check rating condition
            if ($request->filled('rating') && $profile->rating < $request->rating) {
                continue;
            }

            // Check price condition
            if ($request->filled('price') && $profile->price_per_month > $request->price) {
                continue;
            }

            // Passed all checks
            $filtered[] = $trainer;
        }
        return collect($filtered);
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
