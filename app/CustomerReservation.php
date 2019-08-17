<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomerReservation extends Pivot
{
    protected $table = 'customer_reservation';
    
    // アクセサ
    // 着物の種類
    public function getKimonoTypeAttribute()
    {
        switch($this->attributes['kimono_type']){
            case 1:
                return '白無垢';
            
            case 2:
                return '色打掛';
            
            case 3:
                return '紋付袴';
            
            case 4:
                return '振袖';
                
            case 5:
                return '留袖';
            
            case 6:
                return '色留袖';

            case 7:
                return '喪服';
            
            case 8:
                return '訪問着';

            case 9:
                return '付け下げ';
            
            case 10:
                return '色無地';
            
            case 11:
                return '小紋';

            case 12:
                return '女袴';
            
            case 13:
                return '七五三';
        
            case 14:
                return '浴衣';
        
            case 15:
                return 'その他（備考）';
        }
    }

    // 帯の種類
    public function getObiTypeAttribute()
    {
        switch($this->attributes['obi_type']){
            case 1:
                return '名古屋帯';
            
            case 2:
                return '袋帯';
                
            case 3:
                return 'その他（備考）';
        }
    }

    // 帯結び
    public function getObiKnotAttribute()
    {
        switch($this->attributes['obi_knot']){
            case 1:
                return 'お太鼓';
            
            case 2:
                return '二重太鼓';
                
            case 3:
                return '変わり結び';

            case 4:
                return 'その他（備考）';
        }
    }
}
