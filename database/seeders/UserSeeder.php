<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $users = [
            [
                'name' => 'Test User',
                'email' => 'admin@gmail.com',
                'password' => 'admin123',
                'role' => 'admin',
            ],
            [
                'name' => 'Joshi Z. Adlawan',
                'email' => 'teacher1@gmail.com',
                'password' => 'teacher1',
                'role' => 'teacher',
            ],
        ];
        
        foreach ($users as $user) {
            User::factory()->create($user);
        }

        for($i = 1; $i <= 10; $i++) {
            User::factory()->create([
                'name' => fake()->firstName(),
                'email' => 'user' . $i . '@gmail.com',
                'password' => 'user' . $i,
                'role' => 'student',
            ]);
        }
        
    }
}
