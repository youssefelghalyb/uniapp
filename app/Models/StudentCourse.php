<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $guarded = [];

    protected $table = 'students_courses';
    public function students()
    {
        return $this->belongsToMany(Student::class, 'students_courses');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'students_courses');
    }
}
