<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index(){
        $faculty_id = Faculty::where('user_id', Auth::user()->id)->first()->id;
        $faculty_info = Faculty::where('user_id', Auth::user()->id)->first();
        $count = Subject::with('faculty')->where('faculty_id', $faculty_id)->count();
        $level = Subject::with('faculty')->where('faculty_id', $faculty_id)->first();
        $studentCount = Student::where('level',$level)->count();

        // dd($faculty_info);
        return view("teacher.dashboard", compact('count','studentCount', 'faculty_info'));
    }
}
