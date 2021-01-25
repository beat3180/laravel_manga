@extends('layouts.bootstrap')

@section('title','記事一覧')


@section('content')
@include('layouts.header_logined')

@include('layouts.message')

 <!--$contentsに一つ以上値が入っていた場合は表示される-->
  @if(count($contents) > 0)
  <div class="album py-5 bg-light">
    <div class="container">
    <h1 class="mb-5">記事一覧</h1>
      <div class="row">
      <?php foreach($contents as $content){ ?>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm ">
            <a class="link_border" href="contents_detail.php?contents_id=<?php print($content['contents_id']); ?>">
              <?php if($content['image'] !== null){ ?>
              <img class="card-img-top" src="<?php print(IMAGE_PATH . $content['image']); ?>" alt="Card image cap">
              <?php } else { ?>
              <img class="card-img-top" src="/assets/images/漫画デフォルト.png" alt="Card image">
              <?php } ?>
              <div class="card-body">
                <h4 class="card-text border-bottom text-center"><?php print h($content['title']); ?></h4>
                <div class="align-items-center">
                    <p>カテゴリー:<?php print h($content['category']); ?></p>
                    <p>ユーザー名:<?php print h($content['name']); ?></p>
                </div>
                <div><small class="text-muted"><?php print h($content['created_datetime']); ?></small></div>
              </div>
            </a>
            <!--adminユーザーの場合、下を表示-->
            <?php if(is_admin($user)){ ?>
              <div class="d-flex justify-content-between align-items-center mb-4 col-md-4">
                <div class="btn-group">
                  <form method="post" action="contents_change_status.php" class="operation">
                    <?php if(is_open($content) === true){ ?>
                      <input type="submit" value="公開 → 非公開" class="btn btn-sm btn-secondary">
                      <input type="hidden" name="changes_to" value="close">
                    <?php } else { ?>
                      <input type="submit" value="非公開 → 公開" class="btn btn-sm btn-secondary">
                      <input type="hidden" name="changes_to" value="open">
                    <?php } ?>
                    <input type="hidden" name="contents_id" value="<?php print($content['contents_id']); ?>">
                    <input type="hidden" name="admin_contents_change_status" value="admin_contents_change_status">
                    <!--CSRF対策のセッションに登録されたトークンを送信する-->
                    <input type="hidden" name="csrf" value="<?php print($token); ?>">
                  </form>

                  <form method="post" action="contents_delete.php">
                    <input type="submit" value="削除" class="btn btn-sm btn-danger delete">
                    <input type="hidden" name="contents_id" value="<?php print($content['contents_id']); ?>">
                    <!--CSRF対策のセッションに登録されたトークンを送信する-->
                    <input type="hidden" name="csrf" value="<?php print($token); ?>">
                  </form>
                </div>
              </div>
            <?php } ?>

          </div>
        </div>
      <?php } ?>
      </div>

    </div>
  </div>
  <!--$categoryに何も値が入っていない場合-->
    @else
      <p>コンテンツはありません。</p>
    @endif
  <!--jQuery、$('.delete')で要素を特定、confirmでダイアログを開く-->
  <script>
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>


@endsection
