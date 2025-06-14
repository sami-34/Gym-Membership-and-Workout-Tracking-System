<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgressReport;


class ProgressReportController extends Controller
{
    public function index() {
        $progress = ProgressReport::where('user_id', auth()->id())->get();
        $latest = ProgressReport::where('user_id', auth()->id())
            ->orderBy('recorded_date', 'desc')
            ->first();
        return view('member.progress.index', compact('progress', 'latest'));
    }

    public function store(Request $request) {
        ProgressReport::create([
            'user_id' => auth()->id(),
            'weight' => $request->weight,
            'body_fat_percentage' => $request->body_fat,
            'muscle_mass' => $request->muscle,
            'recorded_date' => now()
        ]);
        $request->validate([
            'weight' => 'required|numeric|min:1',
            'body_fat' => 'required|numeric|min:1|max:100',
            'muscle' => 'required|numeric|min:1'
        ]);
        return back();
    }

}
