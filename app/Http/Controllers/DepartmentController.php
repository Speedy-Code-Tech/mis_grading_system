<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view("admin.department.index", compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate(
                [
                    'course_code' => 'required|string',
                    'description' => 'required|string',
                ]
            );
            Department::create($data);
            return redirect()->route('department.index')->with('msg', 'Department Added Successfully!');
        } catch (\Exception $e) {
            // Log the error message for debugging
            Log::error($e->getMessage());  // This will print the error message in the Laravel log

            // Return the error message with the exception's message included
            return redirect()->back()->with('error', 'Failed to Add a Department! Error: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function edit(Department $department)
    {
        if (!$department) {
            return response()->json([
                'error' => 'Department not found'
            ], 404);
        }

        return response()->json([
            'data' => $department
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        try {
            $data = $request->validate(
                [
                    'edepartment' => 'required|string',
                    'edescription' => 'required|string',
                ]
            );
            $value = [
                'course_code' => $data['edepartment'],
                'description' =>  $data['edescription'],
            ];

            $department->update($value);
            
            return redirect()
            ->route('department.index')
            ->with('msg', 'Department updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return redirect()
                ->route('department.index')
                ->with('msg', 'Department Deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('msg', $e->getMessage());
        }
    }
}
