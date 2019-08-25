<?php

namespace App\Http\Controllers;

use App\Connector;
use Illuminate\Http\Request;

class ConnectorController extends Controller
{
    // 一覧表示（検索あり）
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        //　一覧表示のカラムを限定
        $columns = [
            'id',
            'name',
            'address',
            'home_phone',
            'cell_phone',
            'mail',
            'total_count',
            'current_use_date',
        ];

        // 検索、並び替え、ページネーション
        $connectors = Connector::keyword($keyword)
            ->orderBy('total_count','desc')
            ->orderBy('name','asc')
            ->paginate(5, $columns);

        // 連絡者一覧へ
        return view('connectors.index', [
            'connectors' => $connectors,
            'keyword' => $keyword,
        ]);
    }

    // 詳細表示
    public function show(int $id)
    {
        $connector = Connector::find($id);
        
        return view('connectors.show', [
            'connector' => $connector,
            'id' => $id,
        ]);
    }
    

    // 編集フォーム表示
    public function showEditForm()
    {
        return view('connectors.edit');
    }
    
}
