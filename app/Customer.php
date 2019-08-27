<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // タイムスタンプを無効
    public $timestamps = false;

    protected $guarded = ['id'];
    
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

    // アクセサ
    // 体型
    public function getFormattedBodyTypeAttribute()
    {
        switch($this->attributes['body_type']){
            case 1:
                return 'ほそめ';
            
            case 2:
                return 'ふつう';
                
            case 3:
                return 'ふっくら';
        }
    }
}
