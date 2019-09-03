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
    // キーワード検索
    public function scopeKeyword ($query, $keyword)
    {
        // キーワードがあるとき
        $query->when($keyword, function($query, $keyword) {
            return $query
                ->where('name', 'like', '%'.$keyword.'%')
                ->orwhere('furigana', 'like', '%'.$keyword.'%');
        });
    }

    // 氏名検索
    public function scopeMatchMasterName ($query, $request, $i)
    {
        return $query
            ->where('name', $request->input('master_'.$i));
    }   
    
    // アクセサ
    // 優先度
    public function getFormattedRankAttribute()
    {
        switch($this->attributes['rank']){
            case 0:
                return '出張不可';
            
            default:
                return $this->attributes['rank'];
        }
    }
}
