<?php

namespace App\Http\Controllers\Manga;
// 以下を追加
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function top(Request $request)
    {
        return view('manga.top');
    }

    public function index(Request $request)
    {
        return view('manga.index');
    }
}
