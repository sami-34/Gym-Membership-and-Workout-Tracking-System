<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DietPlan;

class DietPlanController extends Controller
{
    public function index() {
        $diets = DietPlan::where('trainer_id', auth()->id())->get();
        return view('trainer.diets.index', compact('diets'));
    }

    public function create() {
        return view('trainer.diets.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration_weeks' => 'required|integer|min:1',
            'calories' => 'required|integer|min:800|max:2000',
            'meals_per_day' => 'required|in:1,2,4,5'
        ]);

        DietPlan::create([
            'trainer_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'duration_weeks' => $request->duration_weeks,
            'calories' => $request->calories,
            'meals_per_day' => $request->meals_per_day
        ]);

        return redirect('/diets');
    }

}
