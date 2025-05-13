<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = [
        'uuid',
        'name',
        'level',
        'department_id',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function subjectTeachers()
    {
        return $this->hasMany(SubjectTeacher::class);
    }
}
