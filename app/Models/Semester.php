<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'name',
        'start_year',
        'end_year',
        'region',
        'division',
        'school_name',
        'school_id',
        'written_work',
        'performance_task',
        'quarterly_assesment',
        'status'
    ]; 
}
