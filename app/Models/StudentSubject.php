<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    //
    protected $fillable = [
        'section_id',
        'subject_teacher_id',
        'semester_id',
    ];

    // Relationship to SubjectTeacher
    public function subjectTeacher()
    {
        return $this->belongsTo(SubjectTeacher::class, 'subject_teacher_id', 'id');
    }

    // Relationship to Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

    // Relationship to Student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    // Relationship to Section
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}
