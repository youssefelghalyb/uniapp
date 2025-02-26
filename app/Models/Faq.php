<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $guarded = [];

    protected $table = 'faq';

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
