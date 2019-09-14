<?php

namespace App\Libs;

class ConnectorRepository
{
    // 連絡者テーブルの登録・更新
    public static function fill($request, $match_connector)
    {
        $match_connector->fill($request->all());
    }

}