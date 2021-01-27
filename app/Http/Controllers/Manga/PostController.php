<?php

namespace App\Http\Controllers\Manga;

use Illuminate\Http\Request;
use App\Category;
use App\Content;
use App\User;
use App\Admin;
// 以下を追加
use App\Http\Controllers\Controller;
//フォームリクエストクラスを継承する
use App\Http\Requests\MangaRequest;
//ユーザーID取得用の継承
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


    public function __construct()
  {

    if(Auth::guard('admin')->check()){
        $this->middleware('auth;admin');
    } else if (Auth::guard('web')->check()) {
        $this->middleware('auth');
    }
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
     {
         $categories = Category::all();
         return view('manga.post',['categories' => $categories]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MangaRequest $request)
    {

        //$this->validate($request,Content::$rules);
        if ($file = $request->image) {
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('uploads/');
            $file->move($target_path, $fileName);
        } else {
            $fileName = "";
        }

        if (Auth::guard('admin')->check()) {
            $admin_id = Auth::guard('admin')->id();
        }
        if (Auth::guard('web')->check()) {
            $user_id = Auth::id();
        }

        $content = new Content;
        if (Auth::guard('admin')->check()) {
            $content->admin_id = $admin_id;
        }
        if (Auth::guard('web')->check()) {
            $content->user_id = $user_id;
        }
        $content->title = $request->title;
        $content->category_id = $request->category_id;
        $content->content = $request->content;
        $content->approved_at = $request->approved_at;
        $content->image = $fileName;
        $content->save();
        return redirect('/manga/index')->with('msg_success', '記事を投稿しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
