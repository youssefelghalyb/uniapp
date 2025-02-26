<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    protected $table = 'departments';
}
