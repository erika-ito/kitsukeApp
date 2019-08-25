<?php

namespace App\Http\Controllers;

use App\Master;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMasterRequest;

class MasterController extends Controller
{
    // 一覧表示（検索あり）
    public function index(Request $request)
    {
        $keyword = $request->keyword;

       // 検索、並び替え、ページネーション
        $masters = Master::keyword($keyword)
            ->orderBy('rank','desc')
            ->orderBy('furigana','asc')
            ->paginate(5);

        // 講師一覧へ
        return view('masters.index', [
            'masters' => $masters,
            'keyword' => $keyword,
        ]);
    }

    // 新規登録フォーム表示
    public function showCreateForm()
    {
        return view('masters.create');
    }

    // 新規登録処理
    public function create(CreateMasterRequest $request)
    {
        $master = new Master();
        $master->fill($request->all());
        $master->save();

        return redirect()->route('masters.index');
    }

}
