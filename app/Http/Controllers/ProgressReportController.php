<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgressReport;
use Carbon\Carbon;



class ProgressReportController extends Controller
{
    public function index() 
    {
        $raw = ProgressReport::where('user_id', auth()->id())
            ->orderBy('recorded_date', 'asc') // for time-series order
            ->get();

        $smoothed = $this->applyMovingAverage($raw);

        $latest = ProgressReport::where('user_id', auth()->id())
            ->orderBy('recorded_date', 'desc')
            ->first();

        return view('member.progress.index', [
            'progress' => $raw,
            'smoothed' => $smoothed,
            'latest' => $latest
        ]);
    }

    /**
     * Algorithm 2: Moving Average
     * Purpose: Smooths fluctuations in muscle mass trends
     * Returns: Array of smoothed data points
     */
    private function applyMovingAverage($progressData, $window = 3)
    {
        $smoothed = [];
        $muscleValues = $progressData->pluck('muscle_mass')->all();

        for ($i = 0; $i < count($muscleValues); $i++) {
            $sum = 0;
            $count = 0;

            for ($j = $i; $j > $i - $window && $j >= 0; $j--) {
                $sum += $muscleValues[$j];
                $count++;
            }

            $avg = $count > 0 ? round($sum / $count, 2) : $muscleValues[$i];
            $smoothed[] = [
                'date' => Carbon::parse($progressData[$i]->recorded_date)->format('Y-m-d'),
                'smoothed_muscle' => $avg
            ];
        }

        return $smoothed;
    }

    public function store(Request $request) 
    {
        $request->validate([
            'weight' => 'required|numeric|min:30|max:300',
            'body_fat' => [
                'required',
                'numeric',
                'min:1',
                'max:100',
                function ($attribute, $value, $fail) use ($request) {
                    // Body fat should be less than weight (assuming same units)
                    if ($value >= $request->weight) {
                        $fail('Body fat percentage must be less than your weight.');
                    }
                }
            ],
            'muscle' => [
                'required',
                'numeric',
                'min:1',
                function ($attribute, $value, $fail) use ($request) {
                    // Muscle mass should be less than weight
                    if ($value >= $request->weight) {
                        $fail('Muscle mass cannot exceed your total weight.');
                    }
                    // Muscle + body fat shouldn't exceed weight (optional)
                    if (($value + $request->body_fat) > $request->weight) {
                        $fail('The sum of muscle mass and body fat cannot exceed your total weight.');
                    }
                }
            ]
        ]);

        ProgressReport::create([
            'user_id' => auth()->id(),
            'weight' => $request->weight,
            'body_fat_percentage' => $request->body_fat,
            'muscle_mass' => $request->muscle,
            'recorded_date' => now()
        ]);

        return back()->with('success', 'Progress report saved successfully!');
    }

}
