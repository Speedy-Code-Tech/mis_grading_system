<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        try {
            $data = $request->only(
                'type', 'level', 'strand',
                'fname', 'mname', 'lname',
                'gender', 'bdate', 'contact',
                'email', 'password',
                'street', 'region', 'province', 'city', 'brgy','section'
            );
        
            // Create user first
            $user = User::create([
                'name' => $data['fname'] . ' ' . ($data['mname'] ? $data['mname'][0] : '') . '. ' . $data['lname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        
            if ($user) {
                $data['user_id'] = $user->id;
                $data['student_id'] = 'STU-' . str_pad(Student::count() + 1, 6, '0', STR_PAD_LEFT);
        
                $student = Student::create($data);
        
                if ($student) {
                    // Both user and student created successfully
                    if (Auth::check() && Auth::user()->role == 'admin') {
                        return redirect('/admin/student/')->with([
                            'msg' => 'Student Registered Successfully!',
                        ]);
                    } else {
                        return redirect('/student/login')->with([
                            'msg' => 'Student Registered Successfully!',
                            'error' => true,
                        ]);
                    }
                } else {
                    // Failed to create student → rollback user
                    $user->delete();
                    return redirect()->back()->with([
                        'msg' => 'Something went wrong. Please try again.',
                        'error' => true,
                    ]);
                }
            } else {
                return redirect()->back()->with([
                    'msg' => 'Something went wrong. Please try again.',
                    'error' => true,
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'msg' => 'Something went wrong. Please try again.',
                'error' => true,
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

        return view('auth.student', compact('sections'));
    }
}
