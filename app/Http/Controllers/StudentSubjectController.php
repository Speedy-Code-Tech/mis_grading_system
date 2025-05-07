<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentSubjectController extends Controller
{
    //

    public function index() {
        $student = Student::where('user_id', Auth::id())->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        $subjects = $student->studentSubjects()
            ->with([
                'subjectTeacher.subject.department', 
                'subjectTeacher.faculty', 
                'subjectTeacher.semester'
            ])
            ->get();

        return view('student.subject.index', compact('subjects'));
    }
}
