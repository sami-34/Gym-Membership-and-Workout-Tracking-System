<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MemberDiet;
use App\Models\DietPlan;
use App\Models\User;

class MemberDietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $diet = DietPlan::first();
        $members = User::where('role', 'member')->get();
        foreach ($members as $member) {
            MemberDiet::create([
                'user_id' => $member->id,
                'diet_plan_id' => $diet->id,
                'notes' => 'Following daily.',
            ]);
        }
    }
}
