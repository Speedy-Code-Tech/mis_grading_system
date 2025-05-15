<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\error;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $students = Student::with(['user', 'section', 'department'])->get();

        return view('admin.student.index', compact('students'));
    }

    public function student()
    {
        $student = Student::where('user_id', Auth::id())->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        // Get the section of the student
        $section = $student->section;

        if (!$section) {
            return redirect()->back()->with('error', 'Section not found.');
        }

        // Get all subject teachers assigned to the section, and eager load their relationships
        $subjects = $section->subjectTeachers()->with([
            'subject.department',
            'faculty',
            'semester'
        ])->get();

        // Fetch the grades for the student
        $grades = DB::table('grades')
            ->join('subjects', 'grades.subject_id', '=', 'subjects.id')
            ->join('subject_teachers', 'subject_teachers.subject_id', '=', 'subjects.id')
            ->join('faculties', 'faculties.id', '=', 'subject_teachers.faculty_id') // Changed to faculties
            ->where('grades.student_id', $student->id)
            ->select('subjects.name as subject', 'faculties.fname as instructor', 'grades.quarter_id', 'grades.final_grade')
            ->get()
            ->groupBy('subject');

        // Transform the data for the datatable
        $formattedGrades = $grades->map(function ($items, $subject) {
            return [
                'subject' => $subject,
                'instructor' => $items->first()->instructor,
                'q1_grade' => optional($items->firstWhere('quarter_id', 1))->final_grade,
                'q2_grade' => optional($items->firstWhere('quarter_id', 2))->final_grade,
                'final_grade' => number_format((optional($items->firstWhere('quarter_id', 1))->final_grade + optional($items->firstWhere('quarter_id', 2))->final_grade) / 2, 2),
                'remarks' => ((optional($items->firstWhere('quarter_id', 1))->final_grade + optional($items->firstWhere('quarter_id', 2))->final_grade) / 2) >= 75 ? 'Passed' : 'Failed',
            ];
        })->values();

        // Pass it to the view
        return view("student.dashboard", compact('formattedGrades'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'type' => 'required',
            'level' => 'required',
            'strand' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'gender' => 'required',
            'bdate' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'password' => 'required',
            'street' => 'required',
            'region' => 'required',
            'province' => 'required',
            'city' => 'required',
            'brgy' => 'required',
            'section_id' => 'required',
        ]);

        try {
            DB::beginTransaction();
            
            // Create the user first
            $user = User::create([
                'name' => $data['fname'] . ' ' . ($data['mname'] ? $data['mname'][0] : '') . '. ' . $data['lname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        
            if (!$user) {
                DB::rollBack();
                return redirect()->back()->with([
                    'error' => 'Failed to create user.'
                ]);
            }
        
            // Add user_id and student_id to the data array
            $data['user_id'] = $user->id;
            $data['student_id'] = 'STU-' . str_pad(Student::count() + 1, 6, '0', STR_PAD_LEFT);

            // If the frontend doesn't send 'track', set it to null
            $data['department_id'] = $request->input('strand', null);

            // Enable Query Log for debugging
            DB::enableQueryLog();
            
            // Create the student with mass assignment
            $student = Student::create([
                'type' => $data['type'],
                'level' => $data['level'],
                'department_id' => $data['strand'],
                'fname' => $data['fname'],
                'mname' => $data['mname'],
                'lname' => $data['lname'],
                'gender' => $data['gender'],
                'bdate' => $data['bdate'],
                'contact' => $data['contact'],
                'user_id' => $data['user_id'],
                'student_id' => $data['student_id'],
                'street' => $data['street'],
                'region' => $data['region'],
                'province' => $data['province'],
                'city' => $data['city'],
                'brgy' => $data['brgy'],
                'section_id' => $data['section_id'],
            ]);
        
            // Check the logs
            // dd(DB::getQueryLog());
        
            if (!$student) {
                DB::rollBack();
                return redirect()->back()->with([
                    'error' => 'Failed to create student.'
                ]);
            }
        
            DB::commit(); // Commit the transaction if successful
        
            // Redirect based on role
            if (Auth::check() && Auth::user()->role == 'admin') {
                return redirect('/admin/student/')->with([
                    'msg' => 'Student Registered Successfully!',
                ]);
            } else {
                return redirect('/student/login')->with([
                    'msg' => 'Student Registered Successfully!',
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction if there is an error
            Log::error('Student creation failed: ' . $e->getMessage());
            return redirect()->back()->with([
                'error' => 'Something went wrong while saving student data.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($student_id)
    {
        $student = Student::where('student_id', $student_id)->firstOrFail();
        return view('admin.student.edit', ['student' => $student]);
    }

    public function viewGrades($student_id) {
        $student = Student::where('student_id', $student_id)->firstOrFail();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        // Get the section of the student
        $section = $student->section;

        if (!$section) {
            return redirect()->back()->with('error', 'Section not found.');
        }

        // Get all subject teachers assigned to the section, and eager load their relationships
        $subjects = $section->subjectTeachers()->with([
            'subject.department',
            'faculty',
            'semester'
        ])->get();

        // Fetch the grades for the student
        $grades = DB::table('grades')
            ->join('subjects', 'grades.subject_id', '=', 'subjects.id')
            ->join('subject_teachers', 'subject_teachers.subject_id', '=', 'subjects.id')
            ->join('faculties', 'faculties.id', '=', 'subject_teachers.faculty_id') // Changed to faculties
            ->where('grades.student_id', $student->id)
            ->select('subjects.name as subject', 'faculties.fname as instructor', 'grades.quarter_id', 'grades.final_grade')
            ->get()
            ->groupBy('subject');

        // Transform the data for the datatable
        $formattedGrades = $grades->map(function ($items, $subject) {
            return [
                'subject' => $subject,
                'instructor' => $items->first()->instructor,
                'q1_grade' => optional($items->firstWhere('quarter_id', 1))->final_grade,
                'q2_grade' => optional($items->firstWhere('quarter_id', 2))->final_grade,
                'final_grade' => number_format((optional($items->firstWhere('quarter_id', 1))->final_grade + optional($items->firstWhere('quarter_id', 2))->final_grade) / 2, 2),
                'remarks' => ((optional($items->firstWhere('quarter_id', 1))->final_grade + optional($items->firstWhere('quarter_id', 2))->final_grade) / 2) >= 75 ? 'Passed' : 'Failed',
            ];
        })->values();

        return view('admin.student.view-grades', compact('formattedGrades'));
    }
    
    public function view($student_id)
    {
        $student = Student::where('student_id', $student_id)->firstOrFail();
        return view('admin.student.view', ['student' => $student]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        try {
           $data= $request->validate([
                'type' => 'required|string',
                'level' => 'required|string',
                'strand' => 'required|string',
                'fname' => 'required|string|max:255',
                'mname' => 'nullable|string|max:255',
                'lname' => 'required|string|max:255',
                'gender' => 'required',
                'bdate' => 'required|date',
                'contact' => 'required|numeric|digits_between:10,15',
                'email' => 'required',
                'password' => 'nullable',
                'street' => 'required|string|max:255',
                'region' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'brgy' => 'required|string|max:255',
                'section' => 'nullable|string|max:255',
            ]);
            
            DB::beginTransaction();
    
            // Find the student
            $student = Student::findOrFail($student->id);
    
            // Find the related user
            $user = User::findOrFail($student->user_id);
    
            // Update user info
            $user->name = $data['fname'] . ' ' . ($data['mname'] ? $data['mname'][0] : '') . '. ' . $data['lname'];
            $user->email = $data['email'];
    
            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }
    
            $user->save();
    
            // Update student info
            $student->update($data);
    
            DB::commit();
    
            if (Auth::check() && Auth::user()->role == 'admin') {
                return redirect('/admin/student/')->with('msg', 'Student Updated Successfully!');
            } else {
                return redirect('/student/login')->with('msg', 'Student Updated Successfully!');
            }
        } catch (\Exception $e) {
            return $e;
            DB::rollBack();
            return redirect()->back()->withInput()->with([
                'msg' => 'Something went wrong. Please try again.',
                'error' => true,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            User::where('id',$student->user_id)->delete();
            // $student->delete();
            return redirect()
                ->route('student.index')
                ->with('msg', 'Student Deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('msg', $e->getMessage());
        }
    }

    public function insert() {
        $sections = Section::all();

        $strands = Department::all();

        return view('auth.student', compact('sections', 'strands'));
    }
}
