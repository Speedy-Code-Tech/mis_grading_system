<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $students = User::where('role', 'student')->get();

        foreach ($students as $user) {
            Student::create([
                'user_id'   => $user->id,
                'type'      => 'Regular',
                'level'     => rand(11, 12),
                'strand'    => 'STEM',
                'fname'     => fake()->firstName(),
                'mname'     => 'Zaballero',
                'lname'     => 'Adlawan',
                'gender'    => rand(1, 2) === 1 ? 'Male' : 'Female',
                'bdate'     => '200' . rand(1, 9) . '-0' . rand(1, 9) . '-1' . rand(0, 9),
                'contact'   => '0912' . rand(100000, 999999),
                'street'    => 'Legaspi Street',
                'region'    => 'Region XIII',
                'province'  => 'Surigao del Sur',
                'city'      => 'Hinatuan',
                'brgy'      => 'Barangay Maharlike',
                'section'   => 'Section ' . rand(1, 5),
            ]);
        }
    }
}
