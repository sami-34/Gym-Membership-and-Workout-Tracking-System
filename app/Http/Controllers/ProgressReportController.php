<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgressReport;


class ProgressReportController extends Controller
{
    public function index() {
    $raw = ProgressReport::where('user_id', auth()->id())->get()->toArray();

        // Apply QuickSort by 'muscle_mass' field
        $sorted = $this->quicksort($raw);

        $latest = ProgressReport::where('user_id', auth()->id())
            ->orderBy('recorded_date', 'asc')
            ->first();

        return view('member.progress.index', [
            'progress' => $sorted,
            'latest' => $latest
        ]);
    }

    /* 
        *ALGORITHM USED: QuickSort on muscle data to find the and sort it by the highest in ascending. 
    */
    private function quicksort($array) {
        if (count($array) < 2) return $array;

        $pivot = $array[0];
        $left = $right = [];

        for ($i = 1; $i < count($array); $i++) {
            if ($array[$i]['muscle_mass'] < $pivot['muscle_mass']) {
                $right[] = $array[$i]; 
            } else {
                $left[] = $array[$i];
            }
        }
        return array_merge($this->quicksort($left), [$pivot], $this->quicksort($right));
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
