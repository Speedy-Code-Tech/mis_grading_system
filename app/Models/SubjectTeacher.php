<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    //
    // public function faculty()
    // {
    //     return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    // }

    protected $fillable = [
        'subject_id',
        'faculty_id',
        'semester_id',
        'section',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Define the relationship to Faculty (Teacher)
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    // Define the relationship to Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
