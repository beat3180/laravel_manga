<?php

namespace App\Http\Controllers\Manga;

use Illuminate\Http\Request;
// 以下を追加
use App\Http\Controllers\Controller;
use App\Category;
use App\Content;
use App\User;
use App\Admin;
//ユーザーID取得用の継承
use Illuminate\Support\Facades\Auth;
//フォームリクエストクラスを継承する
use App\Http\Requests\MangaRequest;
//リダイレクトクラスを継承
use Illuminate\Support\Facades\Redirect;

class MyContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function __construct()
  {
         $this->middleware('auth:web,admin');
  }


    public function index()
    {

        $contents = Content::with(['admin','user','category'])->where('user_id',Auth::guard('web')->id())->where('admin_id',Auth::guard('admin')->id())->get();
        return view('manga.my_contents', ['contents' => $contents]);
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request,$id)
    {
        $content = Content::findOrFail($id);
        $content->approved_at = $request->approved_at;
        $content->save();
        return Redirect::back()->with('msg_success', '記事のステータスを変更しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $contentimage = $content->image;
        if($contentimage !== ""){
            unlink(public_path('uploads/'.$contentimage));
        }
        $content->delete();
        return redirect()->action('Manga\MyContentController@index')->with('msg_success', '記事を削除しました');
    }
}
