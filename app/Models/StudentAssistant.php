<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAssistant extends Model
{
    protected $guarded = [];

    protected $table = 'students_assistants';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }
}
