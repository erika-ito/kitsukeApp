<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public funciton masters()
    {
        return $this->belongsToMany('App\Master');
    }

    public funciton customers()
    {
        return $this->belongsToMany('App\Customer');
    }
}
