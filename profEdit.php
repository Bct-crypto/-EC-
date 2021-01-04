<?php

// DB接続・クエリ実行関連関数の読み込み
require __DIR__ . '/lib/dbConnect.php';
// バリデーション関数の読み込み
require __DIR__ . '/lib/function.php';
// ログイン認証ファイルの読み込み
require __DIR__ . '/lib/auth.php';

if (!empty($_POST)) {
}

$title = 'プロフィール編集';
$content = __DIR__ . '/views/profEdit.php';
include __DIR__ . '/views/layout.php';
