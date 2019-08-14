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
        return view('masters.create');
    }

    // 新規登録処理
    public function create(CreateMasterRequest $request)
    {
        $master = new Master();

        $master->rank = $request->rank;
        $master->name = $request->name;
        $master->furigana = $request->furigana;
        $master->zip_code = $request->zip_code;
        $master->address = $request->address;
        $master->home_phone = $request->home_phone;
        $master->cell_phone = $request->cell_phone;
        $master->mail = $request->mail;

        $master->save();

        return redirect()->route('masters.index');
    }

}
