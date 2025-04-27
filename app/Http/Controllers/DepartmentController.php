<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

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
                    'department' => 'required|string',
                    'description' => 'required|string',
                ]
            );
            Department::create($data);
            return redirect()->route('department.index')->with('msg', 'Department Added Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'Failed to Add a Department!');
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
                'department' => $data['edepartment'],
                'description' =>  $data['edescription'],
            ];
            $department->update($value);
            return redirect()
            ->route('department.index')
            ->with('msg', 'Department Updated successfully!');
        } catch (\Exception $e) {
            return back()->with('msg', $e->getMessage());
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
