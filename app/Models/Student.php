<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "student";

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
        'section'
    ];


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
