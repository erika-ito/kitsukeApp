<?php

namespace App\Http\Controllers;

use App\Master;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    // 一覧表示（検索あり）
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Master::query();

        // キーワードがある場合
        if (! empty($keyword))
        {
            $query->where('name', 'like', '%'.$keyword.'%')
                ->orwhere('furigana', 'like', '%'.$keyword.'%');
        }

        // ページネーション
        $masters = $query->orderBy('rank','desc')
            ->orderBy('furigana','asc')->paginate(5);
        
        return view('masters.index', [
            'masters' => $masters,
            'keyword' => $keyword,
        ]);
    }

    // 新規登録フォーム表示
    public function showCreateForm()
    {
        return view('masters.create', [
            
        ]);
    }

}
