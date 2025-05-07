<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //
    protected $fillable = ['student_id', 'subject_id', 'quarter_id', 'final_grade'];

    public function gradeDetails()
    {
        return $this->hasMany(GradeDetails::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
    
}
