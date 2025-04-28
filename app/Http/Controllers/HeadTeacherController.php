<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Faculty;
use Illuminate\Http\Request;

class HeadTeacherController extends Controller
{
    
    public function index(){
        $faculty_id = Faculty::where('user_id',auth()->user()->id)->first()->id;
        $count = Subject::with('faculty')->where('faculty_id',$faculty_id)->count();
        $level = Subject::with('faculty')->where('faculty_id',$faculty_id)->first()->level;
        $studentCount = Student::where('level',$level)->count();
        return view("head.dashboard",compact('count','studentCount'));

    }
}
