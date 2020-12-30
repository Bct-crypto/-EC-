<?php

// DB接続・クエリ実行関連関数の読み込み
require __DIR__ . '/lib/dbConnect.php';
// バリデーション関数の読み込み
require __DIR__ . '/lib/function.php';

if (!empty($_POST)) {

    // 値を変数に格納
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass_re = $_POST['pass_re'];

    // 空入力チェック
    validRequired($email, 'email');
    validRequired($pass, 'pass');
    validRequired($pass_re, 'pass_re');

    if (empty($errMsg)) {
        // Email形式のチェック
        validEmail($email, 'email');
        // 最小入力数チェック
        validMinLen($email, 'email');
        // 最大入力数チェック
        validMaxLen($email, 'email');
    }
}

$title = 'サインアップ';
$content = __DIR__ . '/views/signup.php';
include __DIR__ . '/views/layout.php';
