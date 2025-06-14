<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgressReport;
use App\Models\User;

class ProgressReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = User::where('role', 'member')->get();
        foreach ($members as $member) {
            ProgressReport::create([
                'user_id' => $member->id,
                'weight' => rand(55, 85),
                'body_fat_percentage' => rand(10, 25),
                'muscle_mass' => rand(40, 65),
                'recorded_date' => now(),
            ]);
        }
    }
}
