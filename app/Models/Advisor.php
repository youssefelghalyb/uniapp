<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    protected $guarded = [];

    protected $table = 'advisors';

    public function students()
    {
        return $this->belongsToMany(Student::class, 'students_advisors');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
