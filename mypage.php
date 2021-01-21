<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// 関数読み込み
require __DIR__ . '/lib/function.php';
// ログイン認証
require __DIR__ . '/lib/auth.php';

debug('MyPageを表示します');
debugLogStart();



// 画面表示データをそれぞれ取得する
$user_id = $_SESSION['user_id'];
// 商品データ
$productData = getMyProduct($user_id);
// 商品表示におけるforeach用の変数
$loop = 0;
// 現在の表示レコード先頭を算出
// ex 1ページ目なら（1-1）*9 =0,２ページ目なら(2-1)*9 = 9
$currentMinNum = (($currentPageNum - 1) * $listSpan);
// プロフィールデータ
$userInfo = getUserInfo($user_id);
// お気に入りデータ
// $getFavorite = getMyFavorite($user_id);

$title = 'MyPage';
$content = __DIR__ . '/views/mypage.php';
include __DIR__ . '/views/layout.php';
