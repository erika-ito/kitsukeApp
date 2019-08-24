<?php

namespace App\Http\Controllers;

use App\Connector;
use Illuminate\Http\Request;

class ConnectorController extends Controller
{
    // 一覧表示（検索あり）
    public function index(Request $request)
    {
        // $keyword = $request->keyword;

        // $query = Connector::query();
        $connectors = Connector::orderBy('total_count','desc')
            ->orderBy('name','asc')
            ->paginate(5);

        // キーワードがある場合
        // if (! empty($keyword))
        // {
        //     $query->where('name', 'like', '%'.$keyword.'%')
        //         ->orwhere('furigana', 'like', '%'.$keyword.'%');
        // }

        // // ページネーション
        // $connectors = $query->orderBy('rank','desc')
        //     ->orderBy('furigana','asc')->paginate(5);
        
        return view('connectors.index', [
            'connectors' => $connectors,
            // 'keyword' => $keyword,
        ]);
    }

    // 新規登録フォーム表示
    // public function showCreateForm()
    // {
    //     return view('connectors.create');
    // }

    // 新規登録処理
    // public function create(CreateConnectorRequest $request)
    // {
    //     $connector = new Connector();
    //     $connector->fill($request->all());
    //     $connector->save();

    //     return redirect()->route('connectors.index');
    // }
}
