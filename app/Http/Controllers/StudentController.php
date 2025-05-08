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
        $students = Student::with('user')->get();
        return view('admin.student.index', compact('students'));
    }
    public function student(){
        return view("student.dashboard");
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
    public function show(Student $student)
    {
        return view('admin.student.edit', ['student'=> $student]);
    }
    public function view(Student $student)
    {
        return view('admin.student.view', ['student'=> $student]);
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
