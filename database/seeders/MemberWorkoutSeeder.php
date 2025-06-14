<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MemberWorkout;
use App\Models\Workout;
use App\Models\User;

class MemberWorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workout = Workout::first();
        $members = User::where('role', 'member')->get();
        foreach ($members as $member) {
            MemberWorkout::create([
                'user_id' => $member->id,
                'workout_id' => $workout->id,
                'progress_notes' => 'Started routine.',
            ]);
        }
    }
}
