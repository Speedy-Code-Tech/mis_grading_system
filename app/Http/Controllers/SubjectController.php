<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Quarter;
use App\Models\Section;
use App\Models\Semester;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $sections = Section::all();
        $subjecAssignment = SubjectTeacher::with([
            'subject', 
            'faculty', 
            'semester', 
            'department', 
            'section',
            'quarter',
        ])->get();

        $quarters = Quarter::all();

        // dd($faculties);
        return view('admin.subject.index', compact(
            'subjects',
            'semesters',
            'departments',
            'faculties',
            'subjecAssignment',
            'sections',
            'quarters',
        ));
    }

    public function teacherAssignment ()
    {
        //
        $semesters = Semester::all();
        $departments = Department::all();
        $faculties = Faculty::all();
        $subjects = Subject::with(['faculty','department'])->get();
        $sections = Section::all();
        $subjecAssignment = SubjectTeacher::with([
            'subject', 
            'faculty', 
            'semester', 
            'department', 
            'section'
        ])->get();

        return view('admin.assign-subjects.index',
            compact(
                'subjects',
                'semesters',
                'departments',
                'faculties',
                'subjecAssignment',
                'sections',
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'subject_code'=>"required|string",
            'name'=>"required|string",
            'level'=>"required",
            'hrs'=>"required",
            'department_id'=>"required",
        ]);
        Subject::create($data);

        return redirect()->back()->with(['msg'=>'Subject Added Succesfuly']);
    }

    public function storeAssignment(Request $request)
    {
        
        $data = $request->validate([
            'subject_id'=>"required",
            'faculty_id'=>"required",
            'semester_id'=>"required",
            'level'=>"required",
            'department_id'=>"required",
            'section_id'=>"required",
            'quarter_id'=>"required",
        ]);

        $exists = SubjectTeacher::where([
            'subject_id'    => $data['subject_id'],
            'faculty_id'    => $data['faculty_id'],
            'semester_id'   => $data['semester_id'],
            'department_id' => $data['department_id'],
            'section_id'    => $data['section_id'],
            'quarter_id'    => $data['quarter_id']
        ])->exists();
    
        if ($exists) {
            return redirect()->back()
                ->with(['error' => 'This assignment already exists.'])
                ->withInput();
        }

        $data['uuid'] = Str::uuid();

        $subjectTeacher = SubjectTeacher::create($data);

        StudentSubject::create([
            'subject_teacher_id' => $subjectTeacher->id,
            'section_id' => $data['section_id'],
            'semester_id' => $data['semester_id'],
            'quarter_id' => $data['quarter_id'],
        ]);

        return redirect()->back()->with(['msg'=>'Assigned Teacher Succesfully']);
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
            'subject_code'=>"required|string",
            'name'=>"required|string",
            'level'=>"required",
            'hrs'=>"required",
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
