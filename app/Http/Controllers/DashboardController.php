<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $semesterCount = Semester::count();
        $departmentCount = Department::count();
        $facultyCount = Faculty::count();
        $studentCount = Student::count();
        $subjectCount = Subject::count();
        return view("admin.dashboard",compact('semesterCount','departmentCount','facultyCount','studentCount','subjectCount'));
    }

    public function strand()
    {
        return view("admin.d-strand");
    }

    public function faculty()
    {
        $faculties = Faculty::all();
        return view("admin.d-faculty", compact('faculties'));
    }

    public function student()
    {
        return view("admin.d-student");
    }

    public function studentDetails($level, $track)
    {
        $department = Department::where('course_code', $track)->firstOrFail();

        // Use its ID to query students
        $students = Student::with('section')->where('level', $level)
                    ->where('department_id', $department->id)
                    ->get();

        return view("admin.d-student-details", compact('students', 'level', 'track'));
    }

    public function subject()
    {
        return view("admin.d-subject");
    }

    public function subjectDetails($level, $track)
    {
        $department = Department::where('course_code', $track)->firstOrFail();

        // Use its ID to query students
        $subjects = Subject::with('department')->where('level', $level)
                    ->where('department_id', $department->id)
                    ->get();

        return view("admin.d-subject-details", compact('subjects', 'level', 'track'));
    }
}
