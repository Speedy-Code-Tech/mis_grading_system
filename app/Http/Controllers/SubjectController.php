<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $semesters = Semester::all();
        $departments = Department::all();
        $faculties = Faculty::all();
        $subjects = Subject::with(['faculty','department'])->get();

        // dd($faculties);
        return view('admin.subject.index', compact('subjects','semesters','departments','faculties'));
    }

    public function teacherAssignment ()
    {
        //
        $semesters = Semester::all();
        $departments = Department::all();
        $faculties = Faculty::all();
        $subjects = Subject::with(['faculty','department'])->get();

        return view('admin.assign-subjects.index', compact('subjects','semesters','departments','faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'name'=>"required|string",
            'faculty_id'=>"required",
            'level'=>"required",
            'department_id'=>"required",
        ]);
        Subject::create($data);
        return redirect()->back()->with(['msg'=>'Subject Added Succesfuly']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $faculties = Faculty::all();
        $departments = Department::all();
        $subject = Subject::find($subject->id);
        return response()->json([
            'subject'=>$subject,
            'faculties' => $faculties,
            'department' => $departments
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $data = $request->validate([
            'name'=>"required|string",
            'faculty_id'=>"required",
            'level'=>"required",
            'department_id'=>"required",
        ]);

        $subject = Subject::findOrFail($subject->id);
        $subject->update($data);
        return redirect()->back()->with(['msg'=>'Subject Updated Succesfuly']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->back()->with('msg','Subject Deleted Successfuly');
    }
}
