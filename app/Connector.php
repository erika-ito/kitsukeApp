<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connector extends Model
{
    // タイムスタンプを無効
    public $timestamps = false;

    // 中間テーブルリレーション
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
