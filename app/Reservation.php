<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // タイムスタンプを無効
    public $timestamps = false;

// リレーション
    public function connector()
    {
        return $this->belongsTo('App\Connector');
    }

    // 中間テーブルリレーション
    public function masters()
    {
        return $this->belongsToMany('App\Master');
    }

    public function customers()
    {
        return $this->belongsToMany('App\Customer')
                    ->withPivot('kimono_type');
    }
}
