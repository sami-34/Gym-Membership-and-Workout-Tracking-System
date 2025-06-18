<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\File;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Admin
        User::firstOrCreate(
            ['email' => 'admin@sameer.com'],
            [
                'name' => 'Sameer Admin',
                'password' => Hash::make('123456789'),
                'role' => 'admin',
            ]
            );

            // Clear unique faker cache
            fake()->unique(true);
        
        //Trainer
        User::factory()->count(2)->create(['role' => 'trainer']);
        
        $json = File::get(database_path('json/trainer.json'));
        $trainers = json_decode($json, true);
        foreach ($trainers as $trainer) {
            User::firstOrCreate(
                ['email' => $trainer['email']],
                [
                    'name' => $trainer['name'],
                    'role' => $trainer['role'],
                    'password' => Hash::make($trainer['password'])
                ]
            );
        }

        //Member
        User::factory()->count(5)->create(['role' => 'member']);

        $json = File::get(database_path('json/member.json'));
        $members = json_decode($json, true);
        foreach ($members as $member) {
            User::firstOrCreate(
                ['email' => $member['email']],
                [
                    'name' => $member['name'],
                    'role' => $member['role'],
                    'password' => Hash::make($member['password'])
                ]
            );
        }            
    }
}
