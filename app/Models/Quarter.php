<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quarter extends Model
{
    //

    public function subjectTeacher()
    {
        return $this->hasMany(SubjectTeacher::class);
    }
}
