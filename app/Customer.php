<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // タイムスタンプを無効
    public $timestamps = faulse;
    
    public funciton reservations()
    {
        return $this->belongsToMany('App\Reservation');
    }
}
