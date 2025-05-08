<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'user_id',
        'semester_id',
        'department_id',
        'department_type',
        'status'
    ];

    public function department() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function semester() {
        return $this->belongsToMany(Semester::class, 'subject_teachers', 'subject_id', 'semester_id')
                ->withPivot('faculty_id', 'section')
                ->withTimestamps();
    }

    // added
    public function subjectTeachers()
    {
        return $this->hasMany(SubjectTeacher::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teachers', 'faculty_id', 'subject_id')
                    ->withPivot('semester_id', 'section')
                    ->withTimestamps();
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class, 'subject_teachers', 'faculty_id', 'semester_id')
                    ->withPivot('subject_id', 'section')
                    ->withTimestamps();
    }

}
