<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connector extends Model
{
    // タイムスタンプを無効
    public $timestamps = false;

    protected $guarded = ['id'];

    // 中間テーブルリレーション
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }

    // アクセサ
    // 小物の購入
    public function getConnectMethodAttribute()
    {
        switch($this->attributes['connect_method']){
            case 1:
                return 'メール';
            
            case 2:
                return 'FAX';
                
            case 3:
                return '郵送';

            case 4:
                return 'その他（備考）';
        }
    }

    // 当院生徒か
    public function getIsStudentAttribute()
    {
        switch($this->attributes['is_student']){
            case 1:
                return '外部';
            
            case 2:
                return '生徒';
        }
    }
}
