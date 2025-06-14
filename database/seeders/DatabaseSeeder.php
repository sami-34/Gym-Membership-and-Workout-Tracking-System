<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password')
        ]);

        $this->call([
            UserSeeder::class,
            TrainerProfileSeeder::class,
            MembershipSeeder::class,
            PaymentSeeder::class,
            WorkoutSeeder::class,
            DietPlanSeeder::class,
            MemberWorkoutSeeder::class,
            MemberDietSeeder::class,
            AttendanceSeeder::class,
            ProgressReportSeeder::class,
        ]);
    }
}
