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

    public function advisors()
    {
        return $this->belongsToMany(Advisor::class, 'students_advisors');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class , 'branch_id');
    }
}
