<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workout;
use App\Models\DietPlan;
use App\Models\MemberDiet;
use Illuminate\Http\Request;
use App\Models\MemberWorkout;
use App\Models\TrainerProfile;


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


    public function recommended()
    {
        $trainers = User::where('role', 'trainer')->with('trainerProfile', 'members')->get();

        // Calculate recommendation score
        $scored = $this->recomScore($trainers);

        $currentTrainer = null;
        if (auth()->check() && auth()->user()->trainer_id) {
            $currentTrainer = User::with('trainerProfile')->find(auth()->user()->trainer_id);
        }

        return view('member.trainers.recommended', compact('scored','currentTrainer'));
    }

    /*
        Custom algo to calculate recommendation score: (rating * member_count) / price
    */
    public function recomScore($trainers)
    {
        return $trainers->map(function ($trainer) {
            $rating = $trainer->trainerProfile->rating ?? 0;
            $price = $trainer->trainerProfile->price_per_month ?? 1;
            $memberCount = $trainer->members->count();

            $ratingWeight = 130;
            $memberWeight = 170;

            $score = ($rating * $ratingWeight + $memberCount * $memberWeight) / max($price, 1);
            // $score = ($rating * ($memberCount + 1)) / max($price, 1);

            return [
                'trainer' => $trainer,
                'score' => round($score, 4),
            ];
        })->sortByDesc('score')
            ->values()  // Reset keys
            ->take(3); ; // LIMIT TO TOP 3
    }


    public function selectTrainer(Request $r) 
    {
        auth()->user()->update(['trainer_id'=>$r->trainer_id]);
        return back()->with('success','Trainer selected!');
    }

    public function unselectTrainer()
    {
        auth()->user()->update(['trainer_id' => null]);
        return back()->with('success', 'Trainer removed successfully.');
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
        // $workouts = MemberWorkout::where('user_id', auth()->id())->with('workout')->get();
        // $diets    = MemberDiet::where('user_id', auth()->id())->with('dietPlan')->get();

        // return view('member.myplan', compact('workouts', 'diets'));
        $userId = auth()->id();
        $trainerId = auth()->user()->trainer_id;

        $plans = [
            'workouts' => MemberWorkout::where('user_id', $userId)->with('workout')->get()->keyBy('day_of_week'),
            'diets' => MemberDiet::where('user_id', $userId)->with('dietPlan')->get()->keyBy('day_of_week')
        ];

        $allWorkouts = null;
        $allDiets = null;

        if (!$trainerId) {
            $allWorkouts = Workout::all();
            $allDiets = DietPlan::all();
        }

        return view('member.myplan', compact('plans', 'allWorkouts', 'allDiets'));
    }


    public function addManualPlan(Request $r)
    {
        $userId = auth()->id();
        // WORKOUT
        if ($r->filled('workout_id')) {
            MemberWorkout::updateOrCreate(
                ['user_id' => $userId, 'day_of_week' => $r->day_of_week],
                ['workout_id' => $r->workout_id]
            );
        } else {
            // If no workout selected, delete existing entry
            MemberWorkout::where('user_id', $userId)
                ->where('day_of_week', $r->day_of_week)
                ->delete();
        }

        // DIET
        if ($r->filled('diet_id')) {
            MemberDiet::updateOrCreate(
                ['user_id' => $userId, 'day_of_week' => $r->day_of_week],
                ['diet_plan_id' => $r->diet_id]
            );
        } else {
            // If no diet selected, delete existing entry
            MemberDiet::where('user_id', $userId)
                ->where('day_of_week', $r->day_of_week)
                ->delete();
        }

        return back()->with('success', 'Plan added!');
    }


    public function autoGeneratePlan()
    {
        $userId = auth()->id();
        $workouts = Workout::inRandomOrder()->take(7)->get();
        $diets = DietPlan::inRandomOrder()->take(7)->get();

        foreach (range(1, 7) as $i) {
            // Fallback: if not enough workouts/diets, reuse random
            $workout = $workouts[$i - 1] ?? $workouts->random();
            $diet = $diets[$i - 1] ?? $diets->random();

            MemberWorkout::updateOrCreate(
                ['user_id' => $userId, 'day_of_week' => $i],
                ['workout_id' => $workout->id]
            );

            MemberDiet::updateOrCreate(
                ['user_id' => $userId, 'day_of_week' => $i],
                ['diet_plan_id' => $diet->id]
            );
        }

        return back()->with('success', 'Weekly plan auto-generated!');
    }

}
