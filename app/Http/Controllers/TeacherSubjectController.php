<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Grade;
use App\Models\GradeDetails;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherSubjectController extends Controller
{
    public function index() {
        $faculty_id = Faculty::where('user_id', Auth::user()->id)->first()->id;
        $subjects = Subject::with('faculty')->where('faculty_id',$faculty_id)->get();
        
        return view("teacher.subject.index",compact('subjects'));
    }

    public function grades() {
        $faculty_id = Faculty::where('user_id', Auth::user()->id)->first()->id;
        $subjects = Subject::with('faculty')->where('faculty_id',$faculty_id)->get();
        
        return view("teacher.grades.grade",compact('subjects'));
    }

    public function store(Request $request)
    {
        $subject_id = $request->input('subject_id');
        $quarter_id = $request->input('quarter_id');
        $uuid = $request->input('uuid');
        $grades = $request->input('grades', []);

        foreach ((array)$grades as $studentId => $data) {
            $student = Student::find((int)$studentId);
            if (!$student) {
                return back()->withErrors(["Student with ID {$studentId} does not exist."]);
            }

            $grade = Grade::firstOrCreate(
                ['student_id' => $studentId, 'subject_id' => $subject_id],
                ['quarter_id' => $quarter_id ?? 1]
            );

            $gradeId = $grade->id;
            
            GradeDetails::where('grade_id', $gradeId)->delete();

            $writtenWorkTotal = array_sum($data['written_work']);
            $performanceTaskTotal = array_sum($data['performance_task']);
            $examTotal = array_sum($data['exam']);

            // --- Apply the percentage weights ---
            $wwScore = ($writtenWorkTotal / 50) * 100 * 0.3;   // 30% of WW
            $ptScore = ($performanceTaskTotal / 50) * 100 * 0.5; // 50% of PT
            $examScore = ($examTotal / 250) * 100 * 0.2;        // 20% of Exam
        
            // --- Compute Final Grade ---
            $finalGrade = $wwScore + $ptScore + $examScore;

            // --- Save to the Grade model ---
            $grade->update([
                'final_grade' => round($finalGrade, 2)  // Rounded to 2 decimal places
            ]);

            foreach (['written_work', 'performance_task', 'exam'] as $criteria) {
                $scores = $data[$criteria] ?? [];
                
                foreach ($scores as $index => $score) {
                    GradeDetails::create([
                        'grade_id'     => $gradeId,
                        'criteria'     => $criteria,
                        'score_index'  => $index,
                        'score'        => $score ?? 0,
                    ]);
                }
            }
        }
        return redirect()
                ->route('teacher.grade.view', $uuid)
                ->with('msg', 'Grades Saved Successfully!');
    }

    public function update(Request $request)
    {
        $subject_id = $request->input('subject_id');
        $grades = $request->input('grades');

        foreach ($grades as $studentId => $data) {
            $student = Student::where('id', (int)$studentId)->first();
            if (!$student) {
                return back()->withErrors(['error' => "Student with ID $studentId does not exist."]);
            }

            $grade = Grade::firstOrCreate(
                ['student_id' => $studentId, 'subject_id' => $subject_id],
                [
                    'student_id' => $studentId,
                    'subject_id' => $subject_id,
                    'quarter_id' => $data['quarter_id'] ?? 1,
                ]
            );

            $gradeId = $grade->id;

            foreach (['written_work', 'performance_task', 'exam'] as $criteria) {
                $scores = $data[$criteria] ?? [];

                foreach ($scores as $index => $score) {
                    $gradeDetail = GradeDetails::where('grade_id', $gradeId)
                                                ->where('criteria', $criteria)
                                                ->first();

                    if ($gradeDetail) {
                        $gradeDetail->update([
                            'score' => $score ?? 0,
                        ]);
                    } else {
                        GradeDetails::create([
                            'grade_id' => $gradeId,
                            'criteria' => $criteria,
                            'position' => $index,
                            'score' => $score ?? 0,
                        ]);
                    }
                }
            }
        }

        return back()->with('success', 'Grades updated successfully.');
    }

}
