<?php

namespace App\Repositories;

use App\Connector;

class ConnectorRepository
{
    // 連絡者テーブルの登録・更新
    public static function new($request)
    {
        // 連絡者テーブルの検索
        $match_connector = Connector::matchConnectorName($request)->first();

        if (empty($match_connector)) {
            // 連絡者登録がない場合、新規登録する
            $match_connector = new Connector();
            $match_connector->total_count = 1; // 初期値
        } else {
            // 連絡者登録がある場合
            $match_connector->total_count += 1; // 利用回数に+1
        }
        
        //　直近利用日
        $match_connector->current_use_date = $request->location_date;
        //　利用回数、直近利用日以外のカラム
        $match_connector->fill($request->all());
        $match_connector->save();

        //　他テーブルの登録に必要なため、インスタンスを返す
        return $match_connector;
    }

    public static function edit($request)
    {
        // 連絡者テーブルの検索
        $match_connector = Connector::matchConnectorName($request)->first();
        
        //　利用回数、直近利用日以外のカラムを更新
        $match_connector->fill($request->all())->save();

        //　他テーブルの登録に必要なため、インスタンスを返す
        return $match_connector;
    }
}