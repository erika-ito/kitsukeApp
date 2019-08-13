<?php

namespace App;

use Carbon\Carbon;
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
                    ->using('App\CustomerReservation')
                    ->withPivot('kimono_type');
    }

    // 日付のフォーマットを変更
    public function getFormattedLocationDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['location_date'])
            ->format('Y/m/d');
    }

    // 時間のフォーマットを変更
    public function getFormattedStartTimeAttribute()
    {
        return Carbon::createFromFormat('H:i:s', $this->attributes['start_time'])
            ->format('H:i');
    }

    public function getFormattedFinishTimeAttribute()
    {
        return Carbon::createFromFormat('H:i:s', $this->attributes['finish_time'])
            ->format('H:i');
    }

    // アクセサ　予約状況
    public function getStatusAttribute()
    {
        switch($this->attributes['status']){
            case 1:
                return '仮予約';
            
            case 2:
                return '講師探し';
                
            case 3:
                return '返信待ち';

            case 4:
                return '予約確定';

            case 5:
                return '給与待ち';

            case 6:
                return '終了';

            case 7:
                return 'キャンセル';
        }
     }
}
