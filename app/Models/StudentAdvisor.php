<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAdvisor extends Model
{
    protected $guarded = [];

    protected $table = 'students_advisors';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
    public function advisor()
    {
        return $this->belongsTo(Advisor::class);
    }
}
