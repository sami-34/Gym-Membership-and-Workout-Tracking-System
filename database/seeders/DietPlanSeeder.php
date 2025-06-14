<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DietPlan;
use App\Models\User;

class DietPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainers = User::where('role', 'trainer')->get();
        foreach ($trainers as $trainer) {
            DietPlan::create([
                'trainer_id' => $trainer->id,
                'title' => 'Basic Muscle Diet',
                'description' => 'High protein, low carb meal plan',
            ]);
        }
    }
}
