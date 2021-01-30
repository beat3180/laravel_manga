<?php

namespace App\Http\Controllers\Manga;

use Illuminate\Http\Request;
// 以下を追加
use App\Http\Controllers\Controller;
use App\Category;
use App\Content;
use App\User;
use App\Admin;
use App\Comment;
//ユーザーID取得用の継承
use Illuminate\Support\Facades\Auth;
//フォームリクエストクラスを継承する
use App\Http\Requests\MangaRequest;
//リダイレクトクラスを継承
use Illuminate\Support\Facades\Redirect;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with(['admin','user','content'])->get();

        return view('manga.admin_comment', ['comments' => $comments]);
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
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return Redirect::back()->with('msg_success', 'コメントを削除しました');
    }
}
