<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CreateController extends Controller
{

    public function create(Request $request)
    {
        $this->validate($request,Category::$rules);
        $category = new Category;
        $form = $request->all();
        unset($form['__token']);
        $category->fill($form)->save();
        return redirect('/manga/create')->with('flash_message', 'カテゴリーを追加しました');;
    }

     public function index(Request $request)
     {
         $categories = Category::all();
         return view('manga.create',['categories' => $categories]);
     }

     public function remove(Request $request)
     {
         Category::find($request->id)->delete();
         return redirect('/manga/create')->with('flash_message', 'カテゴリーを削除しました');;
     }


}
