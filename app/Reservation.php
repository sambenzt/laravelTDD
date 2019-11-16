<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = [];

    public function book()
    {
        $this->belongsTo(Book::class);
    }

}
