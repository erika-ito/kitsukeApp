<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Connector extends Model
{
    // タイムスタンプを無効
    public $timestamps = false;

    // データ挿入カラムを限定
    protected $fillable = [
        'name',
        'furigana',
        'zip_code',
        'address',
        'mark',
        'home_phone',
        'cell_phone',
        'mail',
        'connect_method',
        'is_student',
        'special',
    ];

    // 中間テーブルリレーション
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function customers()
    {
        return $this->hasMany('App\Customer');
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
    public function scopeMatchConnectorName ($query, $request)
    {
        return $query
            ->where('name', $request->name)
            ->orwhere('furigana', $request->furigana);
    }
    
    // アクセサ
    // 小物の連絡方法
    public function getFormattedConnectMethodAttribute()
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
    public function getFormattedIsStudentAttribute()
    {
        switch($this->attributes['is_student']){
            case 1:
                return '外部';
            
            case 2:
                return '生徒';
        }
    }

    // 日付のフォーマットを変更
    public function getFormattedCurrentUseDateAttribute()
    {
        // 日付が入力されたときのみ、フォーマット適用（エラー防止）
        if ($this->attributes['current_use_date']) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['current_use_date'])
                ->format('Y/m/d');
        }
    }
}
