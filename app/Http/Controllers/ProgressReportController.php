<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgressReport;


class ProgressReportController extends Controller
{
    public function index() 
    {
        $sorted = ProgressReport::where('user_id', auth()->id())
                ->orderBy('muscle_mass', 'desc')  // Sort by muscle_mass descending
                ->get();

        $latest = ProgressReport::where('user_id', auth()->id())
            ->orderBy('recorded_date', 'asc')
            ->first();

        return view('member.progress.index', [
            'progress' => $sorted,
            'latest' => $latest
        ]);
    }


    public function store(Request $request) 
    {
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
