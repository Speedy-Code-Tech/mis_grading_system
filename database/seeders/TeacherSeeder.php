<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Faculty::create([
            'user_id' => 2,
            'fname' => 'Joshi',
            'mname' => 'Zaballero',
            'lname' => 'Adlawan',
            'semester_id' => rand(1, 2),
            'department_id' => rand(1, 3),
            'department_type' => 'head_of_track',
            'status' => true,
        ]);
    }
}
