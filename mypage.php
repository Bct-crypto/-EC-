<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// 関数読み込み
require __DIR__ . '/lib/function.php';
// ログイン認証
require __DIR__ . '/lib/auth.php';

// 個人の情報取得に関するSQL


$title = 'MyPage';
$content = __DIR__ . '/views/mypage.php';
include __DIR__ . '/views/layout.php';
