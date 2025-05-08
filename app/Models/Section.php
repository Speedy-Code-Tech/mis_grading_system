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
}
