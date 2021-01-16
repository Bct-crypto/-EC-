<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// Session
require __DIR__ . '/lib/function.php';
// ログイン認証
// require __DIR__ . '/lib/auth.php';

debugLogStart();
debug('TOPページを表示します');

// 画面表示処理用のデータを取得する
// 現在ページのGETパラメータを取得
$currentPageNum = (!empty($_GET['p'])) ? $_GET['p'] : 1;
// パラメータに不正な値が入っていないかチェック
if (!is_int((int)$currentPageNum)) {
    error_log('エラー発生：不正な値が入力されました');
    header('Location:index.php');
}
// 表示件数
$listSpan = 9;
// 現在の表示レコード先頭を算出
// ex 1ページ目なら（1-1）*9 =0,２ページ目なら(2-1)*9 = 9
$currentMinNum = (($currentPageNum - 1) * $listSpan);
// DBから商品データを取得
$dbProductData = getProductList($currentMinNum);
// DBからカテゴリ情報を取得
$dbCategoryData = getCategory();
debug('現在ページ：' . $currentPageNum);

$title = 'TOP | Tech Circle.';
$content = __DIR__ . '/views/index.php';
include __DIR__ . '/views/layout.php';
