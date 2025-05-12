<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index() {

        $faculty_id = Faculty::where('user_id', Auth::user()->id)->first()->id;

        $subject_teacher = SubjectTeacher::with(['subject', 'faculty', 'semester', 'section'])
            ->where('faculty_id', $faculty_id)
            ->get();

        return view("teacher.dashboard", compact('subject_teacher'));
    }

    public function show($uuid) {
        $subject_teacher = SubjectTeacher::with(['subject', 'faculty', 'semester'])
            ->where('uuid', $uuid)
            ->firstOrFail();

        // Step 1: Get all related section IDs
        $sectionIds = StudentSubject::where('subject_teacher_id', $subject_teacher->id)
            ->pluck('section_id')
            ->unique();

        // Step 2: Get male students in those sections
        $Mstudents = Student::with(['grades' => function($query) use ($subject_teacher) {
                $query->where('subject_id', $subject_teacher->subject->id)
                    ->with('gradeDetails');
            }])
            ->whereIn('section_id', $sectionIds)
            ->where('gender', 'Male')
            ->get()
            ->map(function ($student) {
                $criteriaTypes = ['written_work', 'performance_task', 'exam'];

                foreach ($criteriaTypes as $type) {
                    $student->{$type . '_scores'} = collect($student->grades)
                        ->flatMap(fn($grade) => collect($grade->gradeDetails)->where('criteria', $type)->pluck('score'))
                        ->values()
                        ->toArray();
                }

                return $student;
            });

        // Repeat for female students
        $Fstudents = Student::with(['grades' => function($query) use ($subject_teacher) {
                $query->where('subject_id', $subject_teacher->subject->id)
                    ->with('gradeDetails');
            }])
            ->whereIn('section_id', $sectionIds)
            ->where('gender', 'Female')
            ->get()
            ->map(function ($student) {
                $criteriaTypes = ['written_work', 'performance_task', 'exam'];

                foreach ($criteriaTypes as $type) {
                    $student->{$type . '_scores'} = collect($student->grades)
                        ->flatMap(fn($grade) => collect($grade->gradeDetails)->where('criteria', $type)->pluck('score'))
                        ->values()
                        ->toArray();
                }

                return $student;
            });

        return view("teacher.grades.view", compact('subject_teacher', 'Mstudents', 'Fstudents', 'uuid'));
    }

    public function inputGrades($uuid) {
        $subject_teacher = SubjectTeacher::with(['subject', 'faculty', 'semester'])
            ->where('uuid', $uuid)
            ->firstOrFail();

        // Step 1: Get all related section IDs
        $sectionIds = StudentSubject::where('subject_teacher_id', $subject_teacher->id)
            ->pluck('section_id')
            ->unique();

        // Step 2: Get male students in those sections
        $Mstudents = Student::with(['grades' => function($query) use ($subject_teacher) {
                $query->where('subject_id', $subject_teacher->subject->id)
                    ->with('gradeDetails');
            }])
            ->whereIn('section_id', $sectionIds)
            ->where('gender', 'Male')
            ->get()
            ->map(function ($student) {
                $criteriaTypes = ['written_work', 'performance_task', 'exam'];

                foreach ($criteriaTypes as $type) {
                    $student->{$type . '_scores'} = collect($student->grades)
                        ->flatMap(fn($grade) => collect($grade->gradeDetails)->where('criteria', $type)->pluck('score'))
                        ->values()
                        ->toArray();
                }

                return $student;
            });

        // Repeat for female students
        $Fstudents = Student::with(['grades' => function($query) use ($subject_teacher) {
                $query->where('subject_id', $subject_teacher->subject->id)
                    ->with('gradeDetails');
            }])
            ->whereIn('section_id', $sectionIds)
            ->where('gender', 'Female')
            ->get()
            ->map(function ($student) {
                $criteriaTypes = ['written_work', 'performance_task', 'exam'];

                foreach ($criteriaTypes as $type) {
                    $student->{$type . '_scores'} = collect($student->grades)
                        ->flatMap(fn($grade) => collect($grade->gradeDetails)->where('criteria', $type)->pluck('score'))
                        ->values()
                        ->toArray();
                }

                return $student;
            });

        return view("teacher.grades.grade", compact('subject_teacher', 'Mstudents', 'Fstudents', 'uuid'));

    }
}
