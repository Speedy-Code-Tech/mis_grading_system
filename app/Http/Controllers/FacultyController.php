<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::with('department', 'semester', 'user')->get();
        $semesters = Semester::all();
        $departments = Department::all();

        return view("admin.faculty.index", compact('faculties', 'semesters', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request);
        $data = $request->validate([
            'fname' => 'required|string',
            'mname' => 'nullable|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'department_id' => 'required|exists:departments,id',
            'department_type' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // create user
            $user = User::create([
                'name' => $data['fname'] . ' ' . $data['lname'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => 'teacher',
            ]);

            $data['user_id'] = $user->id;

            // create faculty
            Faculty::create($data);

            DB::commit();

            return redirect()->back()->with('msg', 'Faculty Added Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to add a Faculty: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        $faculties = Faculty::with('department', 'semester', 'user')->where('id', $faculty->id)->first();
        $semesters = Semester::all();
        $departments = Department::all();

        return response()->json([
            'faculties' => $faculties,
            'semester' => $semesters,
            'department' => $departments
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        $data = $request->validate([
            'fname' => 'required|string',
            'mname' => 'nullable|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $faculty->user_id, // Ignore current user in unique check
            'password' => 'nullable|string|min:8',
            'department_id' => 'required',
            'status' => 'required',
            'department_type' => 'required|string',
        ]);


        DB::beginTransaction();

        try {
            // Update user
            $user = User::findOrFail($faculty->user_id);
            $updateData = [
                'name' => $data['fname'] . ' ' . $data['lname'],
                'email' => $data['email'],
                'role' => $data['department_type'],
            ];
            
            if (!empty($data['password'])) {
                $updateData['password'] = Hash::make($data['password']);
            }

            $updateData = [
                'role' => 'teacher',
            ];
            
            $user->update($updateData);

            // Update faculty
            $faculty = Faculty::findOrFail($faculty->id);
            $data['user_id'] = $user->id;
            $faculty->update($data);

            DB::commit();

            return redirect()->back()->with('msg', 'Faculty Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to Update a Faculty: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        try {
            $faculty->delete();
            return redirect()
                ->route('faculty.index')
                ->with('msg', 'Faculty Deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('msg', $e->getMessage());
        }
    }
}
