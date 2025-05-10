<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subjects = [
            ['subject_code' => 'MAT-101', 'name' => 'General Mathematics', 'level' => 11, 'hrs' => 3],
            ['subject_code' => 'SCI-101', 'name' => 'Physical Science', 'level' => 11, 'hrs' => 2],
            ['subject_code' => 'ENG-101', 'name' => 'English for Academic Purposes', 'level' => 11, 'hrs' => 3],
            ['subject_code' => 'PROG-101', 'name' => 'Programming 1', 'level' => 11, 'hrs' => 3],
            ['subject_code' => 'ENT-201', 'name' => 'Entrepreneurship', 'level' => 12, 'hrs' => 2],
            ['subject_code' => 'SCI-201', 'name' => 'Earth and Life Science', 'level' => 12, 'hrs' => 3],
            ['subject_code' => 'LIT-201', 'name' => '21st Century Literature', 'level' => 12, 'hrs' => 2],
            ['subject_code' => 'NET-201', 'name' => 'Networking and Communications', 'level' => 12, 'hrs' => 3],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
