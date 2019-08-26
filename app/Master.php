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

    // ローカルスコープ
    public function scopeKeyword ($query, $keyword)
    {
        // キーワードがあるとき
        if (! empty($keyword))
        {
            return $query
                    ->where('name', 'like', '%'.$keyword.'%')
                    ->orwhere('furigana', 'like', '%'.$keyword.'%');
        }
    }
    
    // アクセサ
    // 優先度
    public function getFormattedRankAttribute()
    {
        switch($this->attributes['rank']){
            case 5:
                return 5;
            
            case 4:
                return 4;

            case 3:
                return 3;
            
            case 2:
                return 2;

            case 1:
                return 1;
            
            case 0:
                return '出張不可';
        }
    }
}
