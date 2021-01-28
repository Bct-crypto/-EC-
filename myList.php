<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// 関数読み込み
require __DIR__ . '/lib/function.php';
// ログイン認証
require __DIR__ . '/lib/auth.php';

debug('リスト一覧を表示します');
debugLogStart();

// 画面表示データをそれぞれ取得する
$user_id = $_SESSION['user_id'];
// 商品データ
$productData = getMyProduct($user_id);

// プロフィールデータ
$userInfo = getUserInfo($user_id);
// お気に入りデータ
$favoriteData = getMyFavorite($user_id);

$title = 'MyList';
$content = __DIR__ . '/views/myList.php';
include __DIR__ . '/views/layout.php';
