<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }
}
