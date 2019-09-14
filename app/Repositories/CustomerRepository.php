<?php

namespace App\Libs;

use App\Customer;

class CustomerRepository
{
    // 顧客テーブルの登録・更新
    public static function save($request, $i, $match_connector)
    {
        $match_customer = Customer::matchCustomerName($request, $i)->first();
        
        if (empty($match_customer)) {
            // 顧客データがない場合は新規登録
            $match_customer = new Customer();
        }
        // データの登録・更新
        $match_customer->name = $request->input('name_'.$i);
        $match_customer->furigana = $request->input('furigana_'.$i);
        $match_customer->age = $request->input('age_'.$i);
        $match_customer->height = $request->input('height_'.$i);
        $match_customer->body_type = $request->input('body_type_'.$i);

        $match_connector->customers()->save($match_customer);

        // 中間テーブル（着付対象者）登録に必要なため、customer_idを返す
        return $match_customer->id;
    }

}