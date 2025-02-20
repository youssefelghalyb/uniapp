<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    protected $guarded = [];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'students_assistants');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
