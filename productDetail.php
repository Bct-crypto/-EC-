<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// 関数読み込み
require __DIR__ . '/lib/function.php';
// ログイン認証
require __DIR__ . '/lib/auth.php';

debug('商品詳細ページを表示します');
debugLogStart();





$title = '商品詳細ページ';
$content = __DIR__ . '/views/productDetail.php';
include __DIR__ . '/views/layout.php';
