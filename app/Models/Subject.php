<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        "name",
        "faculty_id",
        "level",
        "department_id"
    ];

    public function faculty() {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function subjectTeachers()
    {
        return $this->hasMany(SubjectTeacher::class);
    }
}
