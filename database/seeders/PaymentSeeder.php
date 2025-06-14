<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\User;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = User::where('role', 'member')->get();
        foreach ($members as $member) {
            Payment::create([
                'user_id' => $member->id,
                'amount' => 1500,
                'payment_date' => now()->subDays(rand(1, 30)),
                'status' => 'paid',
            ]);
        }
    }
}
