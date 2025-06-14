<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Workout;
use App\Models\User;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainers = User::where('role', 'trainer')->get();
        foreach ($trainers as $trainer) {
            Workout::create([
                'trainer_id' => $trainer->id,
                'name' => 'Full Body Beginner',
                'description' => 'Light cardio + bodyweight routine',
                'difficulty_level' => 'beginner',
            ]);
        }
    }
}
