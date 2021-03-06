<?php

return
[
    'TEST_MESSAGE' => 'テスト中です。',
    'ERROR_MESSAGE' => 'エラーが発生しました。',


    'HOME_URL' => '/manga/index',
    'LOGIN_URL' => '/login',
    'SIGNUP_URL' => '/register',
    'CREATE_URL', '/manga/create',
    'POST_URL', '/manga/post',

    //DBcontentsテーブル、statusカラム1
    'CONTENT_OPEN' => 1,
    //DBcontentsテーブル、statusカラム0
    'CONTENT_CLOSE' => 0,

    //コンテンツステータスを設定する定数、連想配列でキーがopenの場合1の値が入り、キーがcloseの場合0の値が入る
    /*define('PERMITTED_CONTENTS_STATUSES', array(
      'open' => 1,
      'close' => 0,
    ));*/


    /*//定数、/assets/images/というドキュメントルートを取得する
    'IMAGE_PATH', '/assets/images/'
    //定数、/var/www/html/というドキュメントルートを取得し、/assets/images/というドキュメントルートに繋げる。
    'IMAGE_DIR', $_SERVER['DOCUMENT_ROOT'] . '/assets/images/'

    //top.phpのドキュメントルート
    'TOP_URL', '/top.php'
    //signup.phpのドキュメントルート
    'SIGNUP_URL', '/signup.php'
    //login.phpのドキュメントルート
    'LOGIN_URL', '/login.php'
    //logout.phpのドキュメントルート
    'LOGOUT_URL', '/logout.php'
    //index.phpのドキュメントルート
    'HOME_URL', '/index.php'
    //cart.phpのドキュメントルート
    'CART_URL', '/cart.php'
    //finish.phpのドキュメントルート
    'FINISH_URL', '/finish.php'
    //history.phpのドキュメントルート
    'HISTORY_URL', '/history.php'
    //post.phpのドキュメントルート
    'POST_URL', '/post.php'
    //create.phpのドキュメントルート
    'CREATE_URL', '/create.php'
    //admin_contents.phpのドキュメントルート
    'ADMIN_CONTENTS_URL', '/admin_contents.php'
    //admin_comment.phpのドキュメントルート
    'ADMIN_COMMENT_URL', '/admin_comment.php'
    //create.phpのドキュメントルート
    'CONTENTS_DETAIL_URL', '/contents_detail.php?contents_id=' . print($contents_id）
    //user_contents.phpのドキュメントルート
    'USER_CONTENTS_URL', '/user_contents.php'
    //admin.phpのドキュメントルート
    'ADMIN_URL', '/admin.php'


    //DBcontentsテーブル、statusカラム1
    'CONTENTS_STATUS_OPEN' => 1,
    //DBcontentsテーブル、statusカラム0
    'CONTENTS_STATUS_CLOSE' => 0,*/


];
