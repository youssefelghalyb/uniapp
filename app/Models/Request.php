<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    
    protected $guarded = [];

    protected $table = 'requests';
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
    public function advisor()
    {
        return $this->belongsTo(Advisor::class);
    }
}
