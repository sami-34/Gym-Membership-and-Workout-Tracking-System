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
            ['price_per_month' => 0, 'rating' => 0, 'description' => '']
        );
        return view('trainer.profile', compact('profile'));
    }

    public function update(Request $request) {
        $request->validate([
            'price_per_month' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $profile = TrainerProfile::where('user_id', Auth::id())->first();
        $profile->update($request->only('price_per_month', 'description'));

        return redirect()->back()->with('success', 'Profile updated!');
    }

}
