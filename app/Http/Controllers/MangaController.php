<?php

namespace App\Http\Controllers;

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
