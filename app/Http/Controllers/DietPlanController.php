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
            'description' => 'required'
        ]);

        DietPlan::create([
            'trainer_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect('/diets');
    }

}
