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

        foreach ($students as $key => $user) {
            Student::create([
                'user_id'   => $user->id,
                'student_id' => 'STU-' . str_pad($key + 1, 6, '0', STR_PAD_LEFT),
                'type'      => rand(1, 2) === 1 ? 'old' : 'new',
                'level'     => rand(11, 12),
                'department_id'    => rand(1, 5),
                'fname'     => fake()->firstName(),
                'mname'     => fake()->lastName(),
                'lname'     => fake()->lastName(),
                'gender'    => rand(1, 2) === 1 ? 'Male' : 'Female',
                'bdate'     => '200' . rand(1, 9) . '-0' . rand(1, 9) . '-1' . rand(0, 9),
                'contact'   => fake()->numerify('09#########'),
                'street'    => fake()->streetAddress(),
                'region'    => fake()->address(),
                'province'  => fake()->address(),
                'city'      => fake()->address(),
                'brgy'      => fake()->address(),
                'section_id'   => rand(1, 4),
            ]);
        }
    }
}
