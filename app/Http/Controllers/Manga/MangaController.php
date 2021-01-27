<?php

namespace App\Http\Controllers\Manga;
// 以下を追加
use App\Http\Controllers\Controller;
use App\Category;
use App\Content;
use App\User;
use App\Admin;
//ユーザーID取得用の継承
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function top(Request $request)
    {
        return view('manga.top');
    }

}
