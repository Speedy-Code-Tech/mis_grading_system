<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubjectTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subjects = Subject::all();
        $faculties = Faculty::all();

        foreach ($subjects as $subject) {
            foreach ($faculties as $faculty) {
                SubjectTeacher::create([
                    'uuid' => Str::uuid(), 
                    'subject_id' => $subject->id,
                    'faculty_id' => $faculty->id,
                    'semester_id' => 1,
                    'department_id' => rand(1, 5),
                    'section' => 'Section ' . rand(1, 10),
                ]);
            }
        }
    }
}
