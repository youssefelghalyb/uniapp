<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['message', 'user_id'];

    protected $table = 'contacts';


    public function user(){
        return $this->belongsTo(User::class);
    }
}
