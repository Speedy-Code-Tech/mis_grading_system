<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeDetails extends Model
{
    //
    protected $fillable = ['grade_id', 'criteria', 'score'];
}
