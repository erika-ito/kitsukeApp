<?php

namespace App\Libs;

use App\Connector;

class ConnectorCommonFunction
{
    // 顧客テーブルの登録・更新
    public static function fill($request, $match_connector)
    {
        //　連絡者テーブルの対象カラムを限定
        $connector_columns = [
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
        ];

        $match_connector->fill($request->only($connector_columns));
    }

}