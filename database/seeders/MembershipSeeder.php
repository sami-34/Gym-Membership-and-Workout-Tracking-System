<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membership;
use App\Models\User;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $members = User::where('role', 'member')->get();
        foreach ($members as $member) {
            Membership::create([
                'user_id' => $member->id,
                'plan_name' => 'Monthly Plan',
                'price' => 1500,
                'start_date' => now()->subDays(rand(1, 30)),
                'end_date' => now()->addDays(30),
                'status' => 'active',
            ]);
        
        }
    }
}
