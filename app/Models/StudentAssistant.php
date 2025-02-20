<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAssistant extends Model
{
    protected $guarded = [];

    protected $table = 'students_assistants';

    public function students()
    {
        return $this->belongsToMany(Student::class, 'students_assistants'); 
    }

    public function assistants()
    {
        return $this->belongsToMany(Assistant::class, 'students_assistants');
    }
}
