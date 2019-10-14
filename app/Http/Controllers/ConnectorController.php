<?php

namespace App\Http\Controllers;

use App\Connector;
use Illuminate\Http\Request;
use App\Http\Requests\ConnectorRequest;

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
            ->orderBy('furigana','asc')
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
    public function showEditForm(int $id)
    {
        $connector = Connector::find($id);

        return view('connectors.edit', [
            'connector' => $connector,
        ]);
    }

    // 編集処理
    public function edit(int $id, ConnectorRequest $request)
    {
        $connector = Connector::find($id);
        $connector->fill($request->all());
        $connector->save();

        return redirect()->route('connectors.show', [
            'id' => $id,
        ]);
    }
}
