<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentSubjectController extends Controller
{
    //

    public function index(){
        return view('student.subject.index');
    }
}
