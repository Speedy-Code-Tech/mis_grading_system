<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'status',
        'name',
        'start_year',
        'end_year',
    ]; 

    public function subject_teachers()
    {
        return $this->hasMany(SubjectTeacher::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->status) {
                // If status is true, make all others false
                self::where('status', true)->update(['status' => false]);
            }
        });

        static::updating(function ($model) {
            if ($model->status) {
                // If status is true, make all others false
                self::where('status', true)->where('id', '!=', $model->id)->update(['status' => false]);
            }
        });
    }
}
