<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'level',
        'strand',
        'fname',
        'mname',
        'lname',
        'gender',
        'bdate',
        'contact',
        'street',
        'region',
        'province',
        'city',
        'brgy',
        'section_id'
    ];


    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function studentSubjects()
    {
        return $this->hasMany(StudentSubject::class, 'section_id', 'id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subjects', 'student_id', 'subject_teacher_id')
                    ->withPivot('semester_id', 'status')
                    ->withTimestamps();
    }

    public function subjectTeachers()
    {
        return $this->hasManyThrough(
            SubjectTeacher::class,
            StudentSubject::class,
            'student_id',
            'id',
            'id',
            'subject_teacher_id'
        );
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class, 'student_subjects', 'student_id', 'semester_id')
                    ->withTimestamps();
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
