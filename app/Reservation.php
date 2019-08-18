<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // タイムスタンプを無効
    public $timestamps = false;

    // 属性保護
    protected $guarded = ['id'];

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
                    ->withPivot('kimono_type', 'obi_type', 'obi_knot');
    }

    // ローカルスコープ
    public function scopeKeyword ($query, $keyword)
    {
        // キーワードがあるとき
        if (! empty($keyword))
        {
            return $query
                    ->join('connectors', 'connectors.id', 'reservations.connector_id')
                    ->where('name', 'like', '%'.$keyword.'%')
                    ->orwhere('furigana', 'like', '%'.$keyword.'%')
                    ->orwhere('location_date', '=', $keyword);
        }
    }

    // アクセサ
    // 日付のフォーマットを変更
    public function getFormattedReservationDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['reservation_date'])
            ->format('Y/m/d');
    }

    public function getFormattedLocationDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['location_date'])
            ->format('Y/m/d');
    }

    //　初回任意
    public function getFormattedToolConnectDateAttribute()
    {
        // 日付が入力されたときのみ、フォーマット適用（エラー防止）
        if ($this->attributes['tool_connect_date']) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tool_connect_date'])
            ->format('Y/m/d');
        }
    }

    public function getFormattedToolConfirmDateAttribute()
    {
        if ($this->attributes['tool_confirm_date']) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tool_confirm_date'])
            ->format('Y/m/d');
        }
    }

    public function getFormattedMasterRequestDateAttribute()
    {
        if ($this->attributes['master_request_date']) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['master_request_date'])
            ->format('Y/m/d');
        }        
    }

    public function getFormattedToolPassDateAttribute()
    {
        if ($this->attributes['tool_pass_date']) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tool_pass_date'])
            ->format('Y/m/d');
        }        
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

    // 金額をカンマで区切る
    public function getCommaTotalPriceAttribute() {

        return number_format($this->attributes['total_price']);
    
    }

    public function getCommaPaymentAttribute() {

        return number_format($this->attributes['payment']);
    
    }

    // 予約状況
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

    // 受付方法
    public function getReservationTypeAttribute()
    {
        switch($this->attributes['reservation_type']){
            case 1:
                return '電話';
            
            case 2:
                return 'メール';
                
            case 3:
                return '対面';
        }
    }

    // 折り返し連絡
    public function getReplyAttribute()
    {
        switch($this->attributes['reply']){
            case 1:
                return '必要';
            
            case 2:
                return '不要';
        }
    }

    // 着付場所分類
    public function getLocationTypeAttribute()
    {
        switch($this->attributes['location_type']){
            case 1:
                return '自宅';
            
            case 2:
                return 'A校';
                
            case 3:
                return 'B校';

            case 4:
                return 'C校';

            case 5:
                return 'D校';

            case 6:
                return 'その他（出張場所）';
        }
    }

    // 小物の購入
    public function getToolBuyingAttribute()
    {
        switch($this->attributes['tool_buying']){
            case 1:
                return 'なし';
            
            case 2:
                return '脱脂綿';
                
            case 3:
                return '腰ひも';

            case 4:
                return 'その他（備考）';
        }
    }
}
