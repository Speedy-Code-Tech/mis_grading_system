<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
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
}
