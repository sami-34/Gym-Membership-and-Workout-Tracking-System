<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\User;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $members = User::where('role', 'member')->get();
        foreach ($members as $member) {
            Attendance::create([
                'user_id' => $member->id,
                'date' => now(),
                'status' => 'present',
            ]);
        }
    }
}
