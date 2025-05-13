<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeadTeacherSubjectController extends Controller
{
    public function index(){
        $faculty_id = Faculty::where('user_id', Auth::user()->id)->first()->id;
        $subjects = Subject::with('faculty')->where('faculty_id',$faculty_id)->get();
        
        return view("teacher.subject.index",compact('subjects'));
    }
}
