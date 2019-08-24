<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    // タイムスタンプを無効
    public $timestamps = false;
    
    // 属性保護
    protected $guarded = ['id'];

    // 中間テーブルリレーション
    public function reservations()
    {
        return $this->belongsToMany('App\Reservation');
    }
}
