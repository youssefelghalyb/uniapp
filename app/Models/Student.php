<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];


    public function courses()
    {
        return $this->belongsToMany(Course::class, 'students_courses');
    }

    public function assistants()
    {
        return $this->belongsToMany(Assistant::class, 'students_assistants');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
