<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TrainerProfile;

class TrainerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainers = User::where('role', 'trainer')->get();
        foreach ($trainers as $trainer) {
            TrainerProfile::create([
                'user_id' => $trainer->id,
                'price_per_month' => rand(1000, 3000),
                'rating' => rand(3, 5),
                'description' => 'Experienced trainer with personalized plans.',
            ]);
        }
    }
}
