@extends('layouts.bootstrap')

@section('title','記事詳細')

@section('style')
img{
  height: 250px;
}

.close_contents {
  background-color: #dddddd;
}
@endsection


@section('content')
@include('layouts.header_logined')

@include('layouts.message')
<div class="{{$content->approved_at}} === true ? '' : 'close_contents'); ">
  <div class="container">
    <div class="position-relative overflow-hidden p-3 p-md-1 m-md-1 text-center bg-light">
        @if($content->image !== "")
          <img src="/uploads/{{$content->image}}" alt="Card image cap">
        @else
          <img src="/uploads/マンガトーカー/漫画デフォルト.png" alt="Card image">
        @endif
    </div>

      <div class="row d-flex">
        <div class="col-sm-5 ml-4">
          <div class="d-flex">
            @if($content->user_id === null)
              <p class="my-auto">{{$content->admin->name}}</p>
            @elseif($content->admin_id === null)
              <p class="my-auto">{{$content->user->name}}</p>
            @endif

            @if(Auth::guard('admin')->check() || Auth::guard('web')->check())
            @if(Auth::guard('admin')->check() || $content->user_id === Auth::guard('web')->id())
            <div class="d-flex justify-content-between align-items-center col-md-4">
              <div class="btn-group">
                <form method="post" action="{{ url('content_detail', ['id' => $content->id]) }}" class="operation">
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

                <form method="post" action="{{ url('content_detail', ['id' => $content->id]) }}">
                @csrf
                {{ method_field('delete') }}
                  <input type="submit" value="削除" class="btn btn-sm btn-danger delete">
                </form>
              </div>
            </div>
            @endif
            @endif
          </div>

          <div class="border py-2 rounded-pill text-center bg-warning">
            <h5>{{$content->category->category}}</h5>
          </div>
        </div>

        <small class="ml-auto">投稿日時:{{$content->created_at}}</small>

      </div>
  </div>



  <div class=" container py-4">
    <div class="text-center">
      <h1 class="font-weight-normal py-4" style="border-bottom: 5px solid;">{{$content->title}}</h1>
      <h4 class="text-left py-3 pb-5 mb-5" style="border-bottom: 3px solid; white-space:pre-wrap;">{{$content->content}}</h4>
    </div>
    <h5 class="">コメント</h5>
    <div class="list-group">
      @foreach ($comments as $comment)
      <div class="list-group-item" aria-current="true">
        <div class="d-flex w-100 justify-content-between">
          @if($comment->user_id === null)
            <p class="mb-1">{{$comment->admin->name}}</p>
          @elseif($comment->admin_id === null)
            <p class="my-auto">{{$comment->user->name}}</p>
          @endif
          <small>{{$comment->created_at}}</small>
        </div>
        <h6 class="my-4 ml-4" style="white-space:pre-wrap;">{{$comment->comment}}</h6>
        @if(Auth::guard('admin')->check() || Auth::guard('web')->check())
        @if(Auth::guard('admin')->check() || $comment->user_id === Auth::guard('web')->id())
        <form method="post" action="{{ url('comment', ['id' => $comment->id]) }}">
        @csrf
        {{ method_field('delete') }}
          <input type="submit" value="削除" class="btn btn-sm btn-danger delete">
        </form>
        @endif
        @endif
      </div>
      @endforeach

      @if(Auth::guard('admin')->check() || Auth::guard('web')->check())
      @if(count($errors) > 0)
      <div class="mt-5">
        <ul>
          @foreach ($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form method="post" action="{{ url('comment')}}">
      @csrf
        <div class="mt-2">
          <label for="comment" class="form-label">コメント投稿</label>
          <textarea name="comment" rows="5" id="comment" class="form-control"></textarea>
          <input type="hidden" name="content_id" value="{{$content->id}}">
        </div>
        <button type="submit" class="btn btn-primary my-3">コメントを投稿する</button>
      </form>
      @endif
    </div>

  </div>

  <!--jQuery、$('.delete')で要素を特定、confirmでダイアログを開く-->
  <script>
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>

</div>

@endsection
