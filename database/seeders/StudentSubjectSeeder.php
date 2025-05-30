<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Semester;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\SubjectTeacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $semester = Semester::where('status', true)->first();

        if (!$semester) {
            $this->command->info("No active semester found. Seeding aborted.");
            return;
        }

        $subjectTeachers = SubjectTeacher::all();

        $students = Student::all();
        $sections = Section::all();

        foreach ($sections as $section) {
            $randomSubjects = $subjectTeachers->random(rand(3, 5));

            foreach ($randomSubjects as $subjectTeacher) {
                StudentSubject::create([
                    'section_id'         => $section->id,
                    'subject_teacher_id' => $subjectTeacher->id,
                    'semester_id'        => $semester->id,
                ]);
            }
        }

        $this->command->info("Student subjects successfully seeded!");
    }
}
