<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // タイムスタンプを無効
    public $timestamps = false;
    
    // リレーション
    public function connector()
    {
        return $this->belongsTo('App\Connector');
    }

    // 中間テーブルリレーション
    public function reservations()
    {
        return $this->belongsToMany('App\Reservation');
    }
}
