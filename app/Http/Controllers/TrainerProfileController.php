<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerProfile;
use Illuminate\Support\Facades\Auth;

class TrainerProfileController extends Controller
{
    public function edit() {
        $profile = TrainerProfile::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'price_per_month' => 0, 
                'rating' => 0, 
                'description' => '',
                'experience_years' => 0,
                'specialization' => null,
                'workout_types' => null
            ]
        );
        return view('trainer.profile', compact('profile'));
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_month' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
            // 'rating' => 'required|integer|min:1|max:5',
            'experience_years' => 'required|integer|min:0',
            'specialization' => 'required|string',
            'workout_types' => 'required|string',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        // Update profile
        $profile = TrainerProfile::where('user_id', Auth::id())->first();
        $profile->update([
            'price_per_month' => $request->price_per_month,
            'experience_years' => $request->experience_years,
            'specialization' => $request->specialization,
            'workout_types' => $request->workout_types,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Profile updated!');
    }

}
