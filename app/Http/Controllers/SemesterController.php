<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semesters = Semester::all();
        return view("admin.semester.index", compact('semesters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'status' => 'required',
                'name' => 'required|string',
                'start_year' => 'required|integer',
                'end_year' => 'required|integer',
            ]);

            Semester::create($data);

            return redirect()
                ->route('semester.index')
                ->with('msg', 'Semester added successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $semester = Semester::find($id);

        if (! $semester) {
            return response()->json([
                'error' => 'Semester not found'
            ], 404);
        }

        return response()->json([
            'data' => $semester
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Semester $semester)
    {
        try {
       
            $data = $request->validate([
                'estatus' => 'required',
                'ename' => 'required|string',
                'estart_year' => 'required|integer',
                'eend_year' => 'required|integer',
            ]);

            $value = [
                'name' => $data['ename'],
                'status'=>$data['estatus'],
                'start_year' => $data['estart_year'],
                'end_year' => $data['eend_year'],
            ];

            $semester->update($value);

            return redirect()
                ->route('semester.index')
                ->with('msg', 'Semester Updated Successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Semester::where('id', $id)->delete();
            return redirect()
                ->route('semester.index')
                ->with('msg', 'Semester Deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('msg', $e->getMessage());
        }
    }
}
