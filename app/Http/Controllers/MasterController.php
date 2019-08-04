<?php

namespace App\Http\Controllers;

use App\Master;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index()
    {
        $masters = Master::orderBy('rank','desc')->paginate(5);
        
        return view('masters/index', [
            'masters' => $masters,
        ]);
    }
}
