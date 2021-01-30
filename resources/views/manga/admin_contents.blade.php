@extends('layouts.bootstrap')

@section('title','記事一覧・管理')

@section('style')
img{
  height: 100px;
}

.close_contents {
  background-color: #dddddd;
}
@endsection


@section('content')
@include('layouts.header_logined')

@include('layouts.message')


  <div class="container">
    <h1 class="my-4">記事一覧・管理</h1>



      <!--$contentsに一つ以上値が入っていた場合は表示される-->
    @if(count($contents) > 0)
      <table class="table table-bordered text-center p-md-3 m-md-3">
        <thead class="thead-light">
          <tr>
            <th>操作</th>
            <th>コンテンツID</th>
            <th>タイトル</th>
            <th>ユーザー名</th>
            <th>カテゴリー</th>
            <th>記事画像</th>
            <th>投稿日時</th>
            <th>更新日時</th>
            <th>本文</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($contents as $content)
          <tr class="{{$content->approved_at}} === true ? '' : 'close_contents'); ">
            <td>
              <form method="post" action="{{ url('admin_contents',['id' => $content->id])}}" class="operation">
              @csrf
              {{ method_field('patch')}}
                @if ($content->is_approved)
                  <input type="submit" value="公開 → 非公開" class="btn btn-sm btn-secondary">
                  <input type="hidden" name="approved_at" value="{{config('const.CONTENT_CLOSE')}}">
                @else
                  <input type="submit" value="非公開 → 公開" class="btn btn-sm btn-secondary">
                  <input type="hidden" name="approved_at" value="{{config('const.CONTENT_OPEN')}}">
                @endif
              </form>

              <form method="post" action="{{ url('admin_contents',['id' => $content->id])}}">
              @csrf
              {{ method_field('delete') }}
                <input type="submit" value="削除" class="btn btn-sm btn-danger delete">
              </form>

              <form action="{{ url('content_detail', ['id' => $content->id]) }}">
              @csrf
               <input type="submit" value="記事詳細へ" class="btn btn-sm btn-primary">
              </form>

            </td>
            <td>{{$content->id}}</td>
            <td>{{$content->title}}</td>
            @if($content->user_id === null)
              <td>{{$content->admin->name}}</td>
            @elseif($content->admin_id === null)
              <td>{{$content->user->name}}</td>
            @endif
            <td>{{$content->category->category}}</td>
            <td>
              @if($content->image !== "")
                <img src="/uploads/{{$content->image}}" alt="Card image cap">
              @else
                <img src="/uploads/マンガトーカー/漫画デフォルト.png" alt="Card image">
              @endif
            </td>
            <td>{{$content->created_at}}</td>
            <td>{{$content->updated_at}}</td>
            <td>{{$content->content}}</td>
          </tr>
         @endforeach
        </tbody>
      </table>
    @else
      <p>記事はありません。</p>
    @endif
  </div>
   <!--jQuery、$('.delete')で要素を特定、confirmでダイアログを開く-->
  <script>
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>
@endsection
