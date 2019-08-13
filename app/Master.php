<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    public function reservations()
    {
        return $this->belongsToMany('App\Reservation');
    }
}
